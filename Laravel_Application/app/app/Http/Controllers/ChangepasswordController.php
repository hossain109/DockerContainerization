<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangepasswordController extends Controller
{
    public function add(){

        $data['title'] = "Change Password";

        return view('admin.change_password.add',$data);
    }

    public function change(ChangePassword $request){

        $request->validated();

        //$user = Auth::user();
        $user = User::getDBUser(Auth::user()->id);
        //user must be send from database other wise save function will not work
        if(Hash::check($request->current,$user->password)){

            $currentPassword = Hash::make($request->new);

           $user->password = $currentPassword;

           $user->save();

           return redirect()->back()->with('success','Password successfully updated');

        }else{
            return redirect()->back()->with('error','Old password not match with current pasword');
        }

       
    }
}
