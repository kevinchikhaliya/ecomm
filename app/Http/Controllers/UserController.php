<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    function login(Request $request){
        $request->validate([
            'email'=>'required',
        ]);
        $user = User::where(['email'=>$request->email])->first();

        if(!$user|| !Hash::check($request->password,$user->password)){
            return "check username";
        }else{
            session()->put('user',$user);
            return redirect('/');
        }
    }
    
    function register(Request $request){
        $request->validate([
            'email'=>'required',
            'name'=>'required',
            'password'=>'required',
        ]);
        $user = User::where(['email'=>$request->email])->first();
        if(!$user){
        $user = new User;
        $user->username = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return redirect('login');
        }else{
        return redirect('login');
        }
    }
    
    function logout()
    {
        Session::forget('user');
        return redirect('login');
    }
    
    function profile($id)
    {   
        $data = User::find($id);
        return view('user.profile',['userprofile'=>$data]);
    }
   
}
