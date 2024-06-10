<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;

use App\Traits\SortTable;
class AcountController extends Controller
{

    use SortTable;


    public function index(Request $request){


            $users = User::latest()->paginate(7);


        return view('layouts.pages.accounts.account' , compact('users'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');



        if ($query) {
            $users = User::where('name', 'LIKE', "%{$query}%")->paginate(7);
        } else {
            $users = User::latest()->paginate(7);
        }

        return view('layouts.pages.accounts.account_list', compact('users'));
    }


    public function back_index(){
        return redirect()->route('account');

    }

    public function getAccount(){
        return view('layouts.pages.accounts.create');
    }
    public function postAccount(AccountRequest $request){



        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt( $request->password),
            'roles' => $request->role,

        ]);



        if (isset($request->email)){



            return redirect()->route('account')->with('msg' , 'Thêm thành công');
        } else {
            return redirect()->route('account')->with('msg' , 'Thêm thất bại');

        }


    }


    public function getEdit($id){
        $users = User::find($id);


        return view('layouts.pages.accounts.edit' , compact('users'));
    }

    public function postEdit($id ,Request $request ){
        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'roles' => $request->role,
        ]);

        return redirect()->route('account')->with('msg' , 'Cập nhật thành công');

    }



    public function deleteAccount($id ){
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }



    }
}
