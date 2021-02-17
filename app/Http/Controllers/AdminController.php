<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;
use App\Models\categories;
use App\Models\order;
use App\Models\posters;
use App\Models\product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class AdminController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email'
        ]);
        $admin = User::where(['email'=>$request->email])->first();
        // dd($admin);
        if($admin->admin==1){
            if(!$admin|| !Hash::check($request->password,$admin->password)){
                return redirect('/admin');
            }else{
                session()->put('admin',$admin);
                return redirect('home');
        }
        }else{
            return redirect('/login');
        }
    }
    public function logout()
    {
        Session::forget('admin');
        return redirect('admin');
    }
    public function showCategory(){
        $data = categories::all();
        return view('admin.category',['category'=>$data]);
    }
    public function addCategory(Request $request){
        $request->validate([
            'cat_name' => 'required',
            
        ]);
        $category= new categories;
        $category->cat_name=$request->cat_name;
        $image=$request->file('cat_image');
        $name=$image->getClientOriginalName();
        $image->move(public_path().'/public/cat_image/', $name);  
        // $data[] = $name;
        // dd($name);
        $category->cat_image=$name;
        $category->save();
        return redirect('admin_category');
    }
    public function deleteCategory($cat_id){
        DB::table('category')->where('cat_id',$cat_id)->delete();
        //  categories::find($cat_id)->delete();
         return redirect('admin_category');
    }

    public function showaddProduct(){
        $data = categories::all();
        return view('admin.add_product',['category'=>$data]);
    }

    public function addProduct(Request $request){
       
        $request->validate([
            'cat_id' => 'required',
            'name' => 'required',
            'size' => 'required',
            'sku' => 'required',
            'price' => 'required',
            'weight' => 'required',
            'weighttype' => 'required',
            'tax' => 'required',
            'mrp'=>'required',
            'stock'=>'required',
            'description'=>'required',
        ]);

        $product = new product;
        $product->cat_id = $request->cat_id;
        $product->productname = $request->name;
        $product->size = $request->size;
        $product->sku=$request->sku;
        $product->price = $request->price;
        $product->weight = $request->weight;
        $product->weighttype = $request->weighttype;
        $product->TAX = $request->tax;
        $product->mrp = $request->mrp;
        $product->stock = $request->stock;
        $product->description = $request->description;
        foreach($request->file('galary') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/public/productimage/', $name);  
                $data[] = $name;  
            }

        $product->galary = implode(",",$data);
        $product->save();

        // dd($product);
        return redirect('addproduct')->with(['message','Product added successfully']); 
    }
    public function showProduct(){
        $data = product::all();
        // dd($data);
        return view('admin.product',['product'=>$data]);
    }

    public function updateProduct(Request $request,$id){
        //dd($request);
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'mrp' => 'required',
            'stock' => 'required',
            'description' => 'required'
        ]);
        $productname=$request->name;
        $price=$request->price;
        $mrp=$request->mrp;
        $stock=$request->stock;
        $description=$request->description;
        
        // $oldimage[]=$request->oldimage;
        // dd($oldimage);
        // $oml=sizeof($oldimage);
        // $newimage[]=$request->newimage;
        // $onl=sizeof($newimage);
        // $i=0;
        // $j=0;
        // for($i=0;$i<$oml;$i++){
        //     for($j=0;$j<$onl;$j++){
        //         if($newimage[$j]==null){
        //             $newimage[$j]=$oldimage[$j];
        //             $data[$j]=$newimage;
        //         }else{
        //             $name=$newimage[$j]->getClientOriginalName();
        //             $newimage[$j]->move(public_path().'/public/productimage/', $name);
        //             $data[$j]=$newimage;    
        //         } 
        //     }
        // }
        // $data[]=$newimage;
        //    dd($data);
        // $galary=implode(",",$data);
        $updatedata=DB::update('update products set productname = ?,price=?,mrp=?,stock=?,description=? where id=?',
        [$productname,$price,$mrp,$stock,$description,$id]);
        // dd($updatedata);

       
        return redirect('admin_products');
    }

    public function deleteProduct($id){
        $image=DB::table('products')->where('id',$id)->first();
        // dd($image);
        $data=explode(',',$image->galary);
        // dd($data);
        $length=sizeof($data);
        // dd($length);
        
        for($i=0;$i<$length;$i++){
            unlink('public/productimage/'.$data[$i]);
        }
        DB::table('products')->where('id',$id)->delete();
        return redirect('admin_products');
    }


    // order
    public function orderList(){
        // $orderlist = order::all();
        $orderlist = DB::table('orders')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select('users.*', 'products.productname','orders.*')->orderByDesc('orders.created_at')->paginate(10);
        // dd($orderlist);
        
        return view('admin.orderlist',['orders'=>$orderlist]);
    }

    function userList(){
        $data=User::all();
        $count=User::count();
        return view('admin.userlist',['data'=>$data,'count'=>$count]);
    }

    function forgotPassword(){
        return view('auth.forgot-password');
    }

    function forgotPasswordpost(Request $request){
        // dd($request);
        $request->validate(['email' => 'required|email']);
        
        $existinguser=User::where('email',$request->email)->count();
        // dd($existinguser);
        if($existinguser>0){
            $status = Password::sendResetLink(
                $request->only('email')
            );
        
            return $status === Password::RESET_LINK_SENT
                        ? back()->with(['status' => __($status)])
                        : back()->withErrors(['email' => __($status)]);
        }else{
            print 'check email address';
            // return redirect()->back();
            // Session::flash('error','please check email');
        }
    }

    function poster(){
        $poster=posters::all();
        $category=categories::all();
        return view('admin.poster',['poster'=>$poster,'category'=>$category]);
    }

    function addPoster(Request $request){
        $request->validate([
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'category' => 'required',
            'heading' => 'required',
            'content' => 'required',
            'discount' => 'required'
       ]);
    //    dd($request);
        $poster = new posters();
        // $files = $request->poster;
        // dd($files);
        if ($files = $request->poster) {
            $destinationPath = 'public/posterimage/'; // upload path
            $profileImage = $files->getClientOriginalName();
            $files->move($destinationPath, $profileImage);
            $insert = "$profileImage";
            // dd($insert['image']);
            $poster->poster = $insert;
         }

        $poster->category = $request->category;
        $poster->heading = $request->heading;
        $poster->content = $request->content;
        $poster->discount = $request->discount;
        $poster->save();

        return redirect('/poster');
    }
    function removePoster($id){
        DB::table('poster')->where('id',$id)->delete();
        return redirect('/poster');
    }
    function postStatus(Request $request){
        $request->validate([
            'status' => 'required',
            'id' => 'required'
        ]);
        $status=$request->status;
        $id=$request->id;
        DB::update('update orders set status = ? where id = ?',[$status,$id]);
        return redirect()->back();
    }
    function receipt($id){
        $receiptdata=DB::table('orders')
        ->join('products','orders.product_id','products.id')
        ->join('users','orders.user_id','users.id')
        ->select('users.*','products.*','orders.*','orders.id as orderid')
        ->where('orders.id',$id)->first();
        // order::where('id',$id)->first();
        // dd($receiptdata);
        return view('admin.invoice',['data'=>$receiptdata]);
    }
}
