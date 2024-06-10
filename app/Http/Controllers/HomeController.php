<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;


use App\Models\Product;
use App\Models\Supplier;
use App\Models\Export;
use App\Models\Warehouse;
use App\Models\Category;
use App\Models\User;
use App\Models\ForgetPass;



use App\Http\Requests\ForgetRequest;



class HomeController extends Controller
{


    public function index(){
        $products = Product::count();
        $suppliers = Supplier::count();
        $warehouses = Warehouse::count();
        $categories = Category::count();


        $currentYear = Carbon::now()->year;
        $product_years = Product::whereYear('created_at', $currentYear)->count();
        $export_years = Export::whereYear('created_at', $currentYear)->count();





        return view('layouts.pages.home', compact('products' , 'suppliers', 'warehouses' ,'categories', 'currentYear' , 'product_years','export_years'));
    }

    public function infor_account(){
        $user = Auth::user();

        return view('layouts.pages.infor_account' , compact('user'));
    }





    // -----------------------------

    //todo : handle  forget password



    public function forget_account(){

       return view('layouts.emails.forget_pass');

    }

    public function forget_accounted(Request $request){
        $user = User::all();


        foreach( $user as $u){

            if($request->email == $u->email){
                // lưu id tài khoản đổi mật khẩu
                $request->session()->put('user_id' , $u->id );

                return redirect()->route('replace_pass');
            }


        }


        return back()->with('msg','Tài khoản không hợp lệ');




    }


    public function replace_pass(){


        return view('layouts.emails.replace_password');
    }

    public function replace_passed(ForgetRequest $request)
    {
        $password = $request->password;
        $confirmPassWord = $request->confirmPassWord;

        $user = User::find(session('user_id'));




        // dd($password , $confirmPassWord);
        if ($password == $confirmPassWord) {

            $token = Str::random(20);
            $user = User::find(session('user_id'));




            ForgetPass::create([
                'email' => $user->email,
                'status' => 'Chưa xác nhận',
                'token' => $token
            ]);



            $request->session()->put('new_pass' , $password );


            Mail::send('layouts.emails.contents',compact('password'), function ($message) use($user) {


                // tiêu đề email
                $message->subject('Xác nhận mật khẩu' );

                $message->to(  $user->email);
            } );
            return back()->with('msg', 'Vui lòng xác nhận trong Email');

        } else {
            return back()->with('msg', 'Mật khẩu không khớp');
        }




    }




        public function acceptPass(){

            $user = User::find(session('user_id'));
            $forget_pass = ForgetPass::all();

            // update for table user
            $user->update([
                'password' => bcrypt(session('new_pass')),
            ]);







            // update for table forgetPasses
            foreach($forget_pass as $f){
                if( $user->email == $f->email  ){

                          // thời gian xử lý
                    $createdAt = Carbon::parse($f->created_at);
                    $now = Carbon::now();

                    // diffInMinutes : minutes

                    if($now->diffInHours($createdAt) <= 1){
                        $f->update([
                            'status' => 'Đã xác nhận',
                        ]);

                        // delete session after confirm
                        session()->forget('user_id');
                        session()->forget('new_pass');



                        return redirect()->route('login')->with('msg' , 'Đổi mật khẩu thành công thành công');
                    } else {
                        // delete session after confirm
                        session()->forget('user_id');
                        session()->forget('new_pass');
                       return redirect()->route('forget_account')->with('msg' , 'Bạn đã bị quá hạn , không thể xác nhận được');

                    }



                }
            }

        }


}
