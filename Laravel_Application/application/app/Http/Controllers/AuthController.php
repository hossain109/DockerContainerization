<?php

namespace App\Http\Controllers;

use App\Http\Requests\FogotPasswordRequest;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(){

        // User::insert([
        //     'name'=>'student',
        //     'email'=>'student@gmail.com',
        //     'password'=>Hash::make('1234')
        // ]);
        if(!empty(Auth::check())){

            if(Auth::user()->user_type ==1){
                return redirect('admin/admin/list');
            }else if(Auth::user()->user_type==2){
                return redirect('teacher/dashboard');
            }else if(Auth::user()->user_type==3){
                return redirect('student/dashboard');
            }else if(Auth::user()->user_type==3){
                return redirect('parent/dashboard');
            }

        }

        return view('auth.login');
    }
    public function doLogin(Request $requet){
       $remember = !empty($requet->remember)?true:false;
        if(Auth::attempt(['email'=>$requet->email,'password'=>$requet->password],$remember))
        {
            if(Auth::user()->user_type ==1){
                return redirect('admin/dashboard');
            }else if(Auth::user()->user_type==2){
                return redirect('teacher/dashboard');
            }else if(Auth::user()->user_type==3){
                return redirect('student/dashboard');
            }else if(Auth::user()->user_type==4){
                return redirect('parent/dashboard');
            }

        }else{
            return redirect()->back()->with('error',"please enter correct email and password");
        }

        return view('admin/dashboard');
    }

    public function forgetPassword(){

        return view('auth.forgot');
    }

    public function submitForgetPassword(FogotPasswordRequest $request){

        $request->validated();

        $user = User::checkMail($request->email);
        //dd($user);

        if(!empty($user)){
           
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail ($user));
            return redirect()->back()->with('success',"please check your mail and reset password");
            
        }else{
            //redirect()->back()->with('error',"Email not found in the send");
            return to_route('submit.password')->with('error',"Email not found in the send");
        }

    }

    public function reset($token){
        
        $user = User::getToken($token);
        //dd($user);
        if(!empty($user)){
            $data['user'] = $user; 
            return view('auth.reset',$data);
        }
        else{
            abort(404);
        }

    }

    public function resetpost($token,Request $request){
        if($request->password == $request->newpassword){

            $user = User::getToken($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect('/')->with('success','password successfully reset');
        }
        else{
            return redirect()->back()->with('error','Password and confirm password does not match');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(url(''));
    }
}
