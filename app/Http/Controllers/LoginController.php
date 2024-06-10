<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class LoginController extends Controller
{


    public function index(){

        if(Auth::check()){
            return redirect()->route('home');

        } else {
            return view('login');
        }


    }




    public function indexed(Request $request){
       $remeber = $request->has('check');

       if(Auth::attempt(['email' => $request->email , 'password' => $request->password] , $remeber)){

          // Xác thực sau thành công để login
          $user = User::where('email' , $request->email)->first();
          Auth::login($user);


        //   create session to call username  and display
        $request->session()->put('username', Auth::user()->name);

       } else {
        return back()->with('msg', 'Tài khoản hoặc mật khẩu không đúng');
       }

       return redirect()->route('home');


    }


    public function logout(){

        Auth::logout();
        session()->forget('username');

        return redirect()->route('login');

    }


}
