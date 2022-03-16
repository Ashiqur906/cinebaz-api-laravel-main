<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;
use Sessions;
use Cart;
use Cinebaz\Media\Models\Media;
use App\Http\Resources\v1\MediaResource;
use Auth;
use Cinebaz\Member\Models\Order;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('member:api');
    }
    public function saveOrder(OrderRequest $request)
    {  
        // return  $request;
        $orders = $request->orders;
        $user               = auth()->user();
        if (!$user) {
            return "Please Signin First";
        }
        $url                = "http://sandbox.mynagad.com:10080/remote-payment-gateway-1.0/api/dfs/verify/payment/" . $request->transection_id;
        $json               = Http::get($url);
        $arr                = json_decode($json, true);
        $check              = Order::where('transaction_id', $request->transection_id)->first();
        $code               = uniqid();
        $getToday           = date('Y-m-d H:i:s');
        $new_time           = date("Y-m-d H:i:s", strtotime('+24 hours'));

        
        if ($request->payment_type == 1) {
            if (!$check) {
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
                        'transaction_id'=> $request->transection_id,
                        'currency'      => 'BDT'
                    ]);
                foreach ($orders as $order) {

                    $createChild = DB::table('order_details')
                        ->Insert([
                            'order_id'         => $create,
                            'media_id'         => $order['media_id'],
                            'member_id'        => $user->id,
                            'regular_price'    => $order['regular_price'],
                            'discounted_price' => $order['discounted_price'],
                            'deadline'         => $new_time,
                            'created_at'       => $arr['orderDateTime'],
                            'updated_at'       => $arr['issuerPaymentDateTime'],
                        ]);
                }

                return response()->json(['success' => 'Transaction Successfully done !']);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction ID already taken !'
                ]);
            }
        } else {
            $create = DB::table('orders')
                ->insertGetId([
                    'code'          => $code,
                    'name'          => $user->name,
                    'email'         => $user->email,
                    'phone'         => $user->phone,
                    'amount'        => $request->cart_total,
                    'status'        => 'Pending',
                    'member_id'     => $user->id,
                    'sub_status'    => 'Active',
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                    'address'       => $user->address,
                    'transaction_id' => $request->transection_id,
                    'currency'      => 'BDT'
                ]);
            foreach ($orders as $order) {
                $createChild = DB::table('order_details')
                    ->Insert([
                        'order_id'   => $create,
                        'media_id'   => $order['media_id'],
                        'regular_price'    => $order['regular_price'],
                        'discounted_price' => $order['discounted_price'],
                        'member_id'  => $user->id,
                        'deadline'   => $new_time
                    ]);
            }
            return response()->json(['success' => true,'message' => 'Transaction Successfully done !']);
        }
       
    }
}
