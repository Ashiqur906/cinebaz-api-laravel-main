<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;use Sessions;use Cart;
use Cinebaz\Media\Models\Media;
use App\Http\Resources\MediaResource;
use Auth;use Cinebaz\Member\Models\Order;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('member:api');
    }
    public function saveOrder(Request $request){
        $cartCollection     = explode(',',$request->media_id);
        $user               = auth()->user();
        if(!$user){
            return "Please Signin First";
        }
        $url                = "http://sandbox.mynagad.com:10080/remote-payment-gateway-1.0/api/dfs/verify/payment/" . $request->transection_id;
        $json               = Http::get($url);
        $arr                = json_decode($json, true);
        $check              = Order::where('transaction_id',$request->transection_id)->first();
        $code               = uniqid();
        $getToday           = date('Y-m-d H:i:s');
        $new_time           = date("Y-m-d H:i:s", strtotime('+24 hours'));
        if($request->payment_type == 1){
            if(!$check){
                $create = DB::table('orders')
                    ->insertGetId([
                        'code'          => $code,
                        'name'          => $user->name,
                        'email'         => $user->email,
                        'phone'         => $arr['clientMobileNo'],
                        'amount'        => $request->cart_total,
                        'status'        => 'Pending',
                        'member_id'     => $user->id,
                        'sub_status'    => 'Active',
                        'created_at'    => $arr['orderDateTime'],
                        'updated_at'    => $arr['issuerPaymentDateTime'],
                        'address'       => $user->address,
                        'transaction_id' => $request->transection_id,
                        'currency'      => 'BDT'
                    ]);
                foreach($cartCollection as $myCart){
    
                    $createChild = DB::table('order_details')
                        ->Insert([
                            'order_id'      => $create,
                            'media_id'      => $myCart,
                            'member_id'     => $user->id,
                            'deadline'      => $new_time,
                            'created_at'    => $arr['orderDateTime'],
                            'updated_at'    => $arr['issuerPaymentDateTime'],
                        ]);
                }

                return response()->json(['success' => 'Transaction Successfully done !']);

            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction ID already taken !'
                ]);
            }
        }else{
            $create = DB::table('orders')
                ->insertGetId([
                    'code'          => $code,
                    'name'          => $user->name,
                    'email'         => $user->email,
                    'phone'         => $user->phone,
                    'amount'        => $request->cart_total,
                    'status'        => 'Pending',
                    'member_id'     => $member->id,
                    'sub_status'    => 'Active',
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                    'address'       => $member->address,
                    'transaction_id'=> $request->transection_id,
                    'currency'      => 'BDT'
                ]);
            foreach($cartCollection as $myCart){
                $createChild = DB::table('order_details')
                    ->Insert([
                        'order_id'   => $create,
                        'media_id'   => $myCart,
                        'member_id'  => $user->id,
                        'deadline'   => $new_time,
                    ]);
            }
            return response()->json(['success' => 'Transaction Successfully done !']);
        }
        return $request;
    }
}
