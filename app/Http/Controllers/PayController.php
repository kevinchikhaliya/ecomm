<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\order;
use App\Models\product;
use App\Models\payment;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PayController extends Controller
{
    public function index()
   {
       $userid=session()->get('user')['id'];
       $userdetail=User::where('id',$userid)->first();
       $amount=cart::where('user_id',$userid)->sum('cart_price');
    //    dd($amount);
        return view('theme.payment',['user'=>$userdetail,'amount'=>$amount]);
   }
   public function pay(Request $request){

        $request->validate([
            'address' => 'required',
            'contact' => 'required',
            
        ]);
        $userId = Session::get('user')['id']; 
        $allcart = cart::where('user_id',$userId)->get();
        foreach($allcart as $cart){
            $order = new order();
            $order->product_id=$cart->product_id;
            $order->user_id=$cart->user_id;
            $order->address=$request->address;
            $order->contact=$request->contact;
            $updatestock=Product::where('id',$cart->product_id)->first();
            // dd($updatestock);
            DB::update('update products set stock=? where id=?',[$updatestock->stock-$cart->quantity,$cart->product_id]);
            // dd($u);
            $order->quantity=$cart->quantity;
            $order->status="pending";
            $price=$cart->cart_price;
            $discount_price=$price-$price*0.05;
            $order->price=number_format($discount_price,2);
            $order->payment_method="Online";
            $order->payment_status="pending";
            // dd($order);
            $order->save();
        }
        cart::where('user_id',$userId)->delete();

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
                    array("X-Api-Key:test_d883b3a8d2bc1adc7a535506713",
                          "X-Auth-Token:test_dc229039d2232a260a2df3f7502"));
        $payload = Array(
            'purpose' => 'NiceSnippets',
            'amount' => $request->amount,
            'phone' => $request->contact,
            'buyer_name' => $request->name,
            'redirect_url' => 'http://localhost:8000/pay-success',
            'send_email' => true,
            'email' => $request->email,
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch); 
        $response = json_decode($response);
        return redirect($response->payment_request->longurl);
 }
 
 public function success(Request $request){
    $input = $request->all();
    // dd($request);
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payments/'.$request->get('payment_id'));
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
    array("X-Api-Key:test_d883b3a8d2bc1adc7a535506713",
    "X-Auth-Token:test_dc229039d2232a260a2df3f7502"));

    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch); 

    if ($err) {
        Session::put('error','Payment Failed, Try Again!!');
        return redirect()->route('event');
    } else {
        $data = json_decode($response);
        // dd($data);
    }
    
    if($data->success == true) {
        
        $userId = Session::get('user')['id']; 
        
        $order1=order::where('user_id',$userId)->orderByDesc('id')->first();
            $order1->update([
                'payment_status' => 'paid'
            ]);
            // Here Your Database Insert Login
            $input['payment_id'] = $data->payment->payment_id;
            $input['order_id'] = $order1->id;
            $input['name'] = $data->payment->buyer_name;
            $input['email'] = $data->payment->buyer_email;
            $input['mobile'] = $data->payment->buyer_phone;
            $input['amount'] = $data->payment->amount;
            Payment::create($input);

            Session::put('success','Your payment has been pay successfully, Enjoy!!');
            return redirect('/myorder'); 
        }
        Session::put('error','Payment Failed, Try Again!!');
        return redirect()->route('event');
    }
}
