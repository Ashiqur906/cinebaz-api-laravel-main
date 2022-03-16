<?php

namespace App\Http\Controllers\Api\v0;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Mail;use DB;use Carbon\Carbon;
use Illuminate\Support\Str;
use Cinebaz\Member\Http\Requests\MemberFV;
use Cinebaz\Member\Models\Member;
use Cinebaz\Member\Models\OrderDetails;
use Cinebaz\Member\Models\Order;
use Cinebaz\Media\Models\PlayListLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\MemberNotification;
use Cinebaz\Notification\Models\UserNotification;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\BillingResource;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\PlaylogResource;
use App\Http\Resources\NotificationResource;

class MemberController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('member:api', ['except' => ['login', 'signup','forgate_password','reset_password']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */ 
    public function login2($credentials){     
        // return $credentials['email'];
        $user = Member::where('email',$credentials['email'])->first();
        
        if ($token = Auth::login($user)) {

            return $this->respondWithToken($token);
        }

        return response()->json([
            'is_loggedin'   => false,
            'access_token'  => null,
            'token_type'    =>  null,
            'expires_in'    =>  null,
            'massege'       => 'Unauthorized'
        ], 401);
    }
    public function login(Request $request){

        $credentials = $request->only('email', 'password');


        if ($token = $this->guard()->attempt($credentials)) {

            return $this->respondWithToken($token);
        }
 
        return response()->json([
            'is_loging' => false,
            'access_token' => null,
            'token_type' =>  null,
            'expires_in' =>  null,
            'massege' => 'Unauthorized'
        ], 401);
    }
    public function forgate_password(Request $request){
        $check = Member::where('email',$request->email)->first();
        if(!$check){
            return response()->json([
                'massege'       => 'email doesn`t match'
            ]);
        }else{
            $dltAttempts = DB::table('password_resets')->where('email',$request->email)->delete();
        }
        $token = Str::random(64);
        $data = [
            'subject'   => 'Password Reset',
            'email'     => $request->email,
            'content'   => config('app.web_url').'/password/reset/?token='.$token.'&&email='.$request->email
        ];
        
        try{
            Mail::send('email-template', $data, function($message) use ($data) {
                $message->to($data['email'])
                ->subject($data['subject']);
            });
            DB::table('password_resets')->insert([
                'email'         => $request->email, 
                'token'         => $token, 
                'created_at'    => Carbon::now()
            ]);
            return Redirect::to(config('app.web_url').'/password/forgot/status');

        }catch(\Exception $e) {
            return response()->json([
                'massege'       => 'Unsuccess Attempts'
            ], 401);
        }
        
        return $request;
    }
    public function reset_password(Request $request){
        
        $validator = Validator::make($request->all(), [
           
            'token'             =>      'required',
            'password'          =>      'required|min:6',
            'confirm_password'  =>      'required|same:password'
           ]
       );

        if ($validator->fails()) {
            $error = '';
            foreach($validator->errors()->messages() as $key => $valu){
             $error .= ucfirst($key).': [' .$valu[0].'] ';
            }
            return response()->json([
                 'success' => false,
                 'message' => $error
             ]);
            
        }else {
            try{
                $checkToken = DB::table('password_resets')
                    ->where('email',$request->email)
                    ->where('token',$request->token)
                    ->get();
                if($checkToken){
                    $attributes = [
                        'password'      => Hash::make($request->get('password')),
                    ];
                    $user               = Member::where('email',$request->email)->first();
                    $sumbit             = Member::where('email', $request->email)->update($attributes);
                    // if ($token = Auth::login($user)) {
                    //     return $this->respondWithToken($token);
                    // }
                    return Redirect::to(config('app.web_url').'/password/reset/status');
                }else{
                    return response()->json([
                        'massege'       => 'token doesn`t match'
                    ]);
                }
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect()->back()->withErrors($ex->getMessage())
                    ->with('myexcep', $ex->getMessage())->withInput();
            }

        }
    }
    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(){
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(){
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token){
        return response()->json([
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'expires_in'    => $this->guard()->factory()->getTTL() * 60,
            'message'       => 'Login Successfully Done!',
            'is_login'      => true
        ]);
    }
    public function signup(Request $request){

        $validator = Validator::make($request->all(), [
           
            'name'      => 'required',
            'email'     => 'required|email|max:191|unique:members,email,' . $request->get('id'),
            // 'phone'     => 'required|max:191|unique:members,phone,' . $request->get('id'),
            'password'  => 'required|max:191|min:6',
            // 'gender'    => 'required',
           ]
       );
      // return $request;

       // process the login
       if ($validator->fails()) {
           $error = '';
           foreach($validator->errors()->messages() as $key => $valu){
            $error .= ucfirst($key).': [' .$valu[0].'] ';
           }
           return response()->json([
                'success' => false,
                'message' => $error
            ]);
           
       } else {
            $attributes = [
                'name'      => $request->get('name'),
                'email'     => $request->get('email'),
                'phone'     => $request->get('phone'),
                'password'  => Hash::make($request->get('password')),
                'gender'    => $request->get('gender'),
            ];

        // Member::create($attributes);
        try {
            Member::create($attributes);
            return response()->json([
                'success' => true,
                'message' => 'Successfully registered Member'
            ]);
            }catch (\Illuminate\Database\QueryException $ex) {
                // return $ex;
                return response()->json([
                    'success' => false,
                    'message' => 'Got Problem to register Member'
                ]);
            }
        }
    
    }
    public function profileUpdate(Request $request){

        $validator = Validator::make($request->all(), [
           
            'name'      => 'required',
            //'email'     => 'required|email|max:191|unique:members,email,' . $request->get('id'),
            // 'phone'     => 'required|max:191|unique:members,phone,' . $request->get('id'),
            // 'password'  => 'required|max:191|min:6',
            // 'gender'    => 'required',
           ]
       );
       //return auth()->user();
       // process the login
       if ($validator->fails()) {
           $error = '';
           foreach($validator->errors()->messages() as $key => $valu){
            $error .= ucfirst($key).': [' .$valu[0].'] ';
           }
           return response()->json([
                'success' => false,
                'message' => $error
            ]);
           
       }else {
        $attributes = [
            'name'      => $request->get('name'),
            'email'     => $request->get('email'),
            'phone'     => $request->get('phone'),
            'gender'    => $request->get('gender'),
        ];

        // Member::create($attributes);
        try {
            $existing       =  Member::findOrFail(auth()->user()->id);
            $sumbit         =  Member::where('id', auth()->user()->id)->update($attributes);
            $existing->save();
            return response()->json([
                'success' => true,
                'message' => 'Successfully registration updated !'
            ]);
            }catch (\Illuminate\Database\QueryException $ex) {
                // return $ex;
                return response()->json([
                    'success' => false,
                    'message' => 'Got Problem to register Member'
                ]);
            }
        }
    
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard(){
        return Auth::guard();
    }
    public function member_profile(Request $request){
        $member     = auth()->user();
        if($member){
            return new ProfileResource($member);
        }else{
            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    => null,
                'expires_in'    => null,
                'massege'       => 'Unauthorized'
            ], 401);
        }

    }
    public function member_billings(Request $request){
        $member     = auth()->user();
        $limit  = ($request->limit)? $request->limit : 10;
        if($member){
            $billings = OrderDetails::where('member_id',$member->id)->paginate($limit);
            return BillingResource::collection($billings);
        }else{
            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    => null,
                'expires_in'    => null,
                'massege'       => 'Unauthorized'
            ], 401);
        }

    }
    public function member_invoice(Request $request){
        $member     = auth()->user();
        $limit      = ($request->limit)? $request->limit : 10;
        if($member){
            $getOrder   = Order::where('transaction_id',$request->transaction_id)->first();
            if($getOrder){
                return new InvoiceResource($getOrder);
            }else{
                return response()->json([
                    'is_loging' => true,
                    'massege'   => 'data Not found'
                ], 404);
            }
        }else{
            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    => null,
                'expires_in'    => null,
                'massege'       => 'Unauthorized'
            ], 401);
        }

    }
    public function member_playlog(Request $request){
        $member     = auth()->user();
        $limit      = ($request->limit)? $request->limit : 10;
        if($member){
            $playlistlog = PlayListLog::where('member_id',$member->id)->paginate($limit)->unique('video_id');
            return PlaylogResource::collection($playlistlog);
        }else{
            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    => null,
                'expires_in'    => null,
                'massege'       => 'Unauthorized'
            ], 401);
        }

    }

    // NOtification

    public function all_notification(){
        $member     = auth()->user();
        if($member){
            $notification = UserNotification::where('notifiable_id',$member->id)->get();
            return NotificationResource::collection($notification);
        }else{
            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    => null,
                'expires_in'    => null,
                'massege'       => 'Unauthorized'
            ], 401);
        }
       
    }
    public function single_notification(Request $request){
        $member             = auth()->user();
        
        if($member){
            $notification   = UserNotification::where('notifiable_id',$member->id)->find($request->id);
            return new NotificationResource($notification);
        }else{
            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    => null,
                'expires_in'    => null,
                'massege'       => 'Unauthorized'
            ], 401);
        }
       
    }
    public function read_notification(Request $request){
        $member             = auth()->user();
        
        if($member){
            $notification   = UserNotification::where('notifiable_id',$member->id)
                ->where('read_at',null)
                ->find($request->id);
            if($notification){
                $upData         = $notification->update(['read_at' => now()]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Successfully read done !'
            ]);
        }else{
            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    => null,
                'expires_in'    => null,
                'massege'       => 'Unauthorized'
            ], 401);
        }
       
    }
    public function delete_notification(Request $request){
        $member             = auth()->user();
        
        if($member){
            
            try {
                $notification   = UserNotification::where('notifiable_id',$member->id)
                    ->find($request->id);
                $deleteData     = $notification->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Successfully Deleted done !'
                ]);
            }catch (\Illuminate\Database\QueryException $ex) {
                return response()->json([
                    'success' => false,
                    'message' => 'Got Problem to Delete'
                ]);
            }
            
        }else{
            return response()->json([
                'is_loging'     => false,
                'access_token'  => null,
                'token_type'    => null,
                'expires_in'    => null,
                'massege'       => 'Unauthorized'
            ], 401);
        }
       
    }

}
