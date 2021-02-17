<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\cart;
use App\Models\categories;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\order;
use App\Models\posters;
use App\Models\User;

class ProductController extends Controller
{
    function index(){
        $data = Product::all();
        $category = categories::all();
        // dd($data);
        return view('theme.shop',['product'=>$data,'category'=>$category]);
    }
    function detail($id){
        $data = DB::table('products')
        ->join('category','products.cat_id','category.cat_id')
        ->select('category.cat_name','products.*')->where('products.id',$id)->first();
        // dd($data);
        return view('theme.product',['detail'=>$data]);
    }
    function search(Request $req){
        $req->validate([
            'query' => 'required'
        ]);
        $data = Product::where('productname','like','%' .$req->input('query').'%')->get();
        $category=categories::all();
        return view('theme.search',['products'=>$data,'category'=>$category]);
    }

    function addtocart(Request $req){
        $req->validate([
            'quantity'=>'required',
            'price'=>'required',
            // 'id' => 'required',
            'product_id' => 'required'
        ]);
        
            $cart = new cart();
            $cart->user_id=$req->session()->get('user')['id'];
            $cart->quantity=$req->quantity;
            $cart_price=$req->quantity * $req->price;
            $cart->cart_price=$cart_price;
            $cart->product_id=$req->product_id;
            $cart->save();
            // dd($cart);
            return redirect('/');
      
    }
    static function cartItem()
    {   
        $userId = Session::get('user')['id'];
        return cart::where('user_id',$userId)->count(); 
    }
    function cartlist()
    {
        $userId = Session::get('user')['id'];
        // $data=cart::all();
        $data = DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        // ->join('users','users.id','=','cart.user_id')
        ->select('products.*','cart.quantity','cart.id as cart_id')->where('cart.user_id',$userId)->get();
        // dd($data);   
        return view('theme.shopping-cart',['cartlist'=>$data]);
    }
    function removeCart($id){
        cart::destroy($id);
        return redirect('cart');
    }
    function ordernow(){
        $userId = Session::get('user')['id'];
        $total = DB::table('cart')
        ->join('products','cart.product_id','products.id')
        // ->join('users','cart.user_id','users.id')
        ->select('products.*','cart.id as cart_id','users.*')->where('cart.user_id',$userId)->sum('cart.cart_price');
        
        $user=User::where('id',$userId)->first();
        return view('user.ordernow',['total'=>$total,'user'=>$user]);
    }
    function orderPlace(Request $req){
        $req->validate([
            'address' => 'required',
            'contact' => 'required',
            
        ]);
        $userId = Session::get('user')['id']; 
        $allcart = cart::where('user_id',$userId)->get();
        foreach($allcart as $cart){
            $order = new order();
            $order->product_id=$cart->product_id;
            $order->user_id=$cart->user_id;
            $order->address=$req->address;
            $order->contact=$req->contact;
            $updatestock=Product::where('id',$cart->product_id)->first();
            // dd($updatestock);
            DB::update('update products set stock=? where id=?',[$updatestock->stock-$cart->quantity,$cart->product_id]);
            // dd($u);
            $order->quantity=$cart->quantity;
            $order->status="pending";
            $order->price=$cart->cart_price;
            $order->payment_method=$req->payment;
            $order->payment_status="pending";
            // dd($order);
            $order->save();
        }
        cart::where('user_id',$userId)->delete();
        return redirect('/myorder');
    // }
    }
    function myOrder(){
        if(Session::has('user')){
        $userId = Session::get('user')['id'];
        $order =  DB::table('orders')
        ->join('products','orders.product_id','products.id')
        ->where('orders.user_id',$userId)->get();
        
        return view('user.myorder',['order'=>$order]);
        
    }else{
        return redirect('/login');
        }
    }
    static function category(){
        return categories::all();
    }
    function catview($cat_id){

        $data = product::where('cat_id',$cat_id)->get();
        $category = categories::all();
        return view('theme.catview',['cat'=>$data,'category'=>$category]);
    }
    function mainpage(){
        $poster=posters::all();
        // dd($poster);
        $category=categories::all()->take(3);
        // dd($category);
        return view('theme.index',['poster'=>$poster,'category'=>$category]);
    }
    // function priceRange(Request $request){
    //     // dd($request);
    //     $category=categories::all();
    //     $min=$request->input('min');
    //     $max=$request->input('max');        
    //     $data=product::whereBetween('price',[$min, $max])->get();
    //     return view('theme.search',['products'=>$data,'category'=>$category]);
    // }
}
