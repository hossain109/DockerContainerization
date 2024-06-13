<?php

namespace App\Http\Controllers;

use App\Http\Requests\serachAdmin;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\Visibility;

class AdminController extends Controller
{
    public function list(){

        $data['title']="Admin List";

        $admins = User::getAdmins();

        $data['admins']=$admins;

        return view('admin.admin.list',$data);
    }
    public function add(){

        $data['admin'] = new User();

        $data['title']='Add Admin';

        return view('admin.admin.add',$data);
    }
    public function store(UserRequest $request){
        $request->validated();
        $admin = new User();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->name);
        $admin->user_type=1;
        $admin->save();

        return redirect('admin/admin/list')->with('success',"data inserted successfully");
    }

    public function modify(User $admin){

        return view('admin.admin.add',['admin'=>$admin]);
    }
    public function update(Request $request,User $admin){
        $request->validate([
            'name'=>'required|string|min:2',
            'email'=>'required|email|unique:users',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        if(!empty(trim($request->password))){
            $request->validate([
                'password'=>'required|min:4',
            ]);
            $admin->password = Hash::make($request->password);
        }
       
        $admin->save();
      
        return to_route('admin.list')->with('success',"data updated successfully");
        
    }

    public function delete(User $admin){

        $admin->delete();
        return redirect('admin/admin/list')->with('success','admin deleted with successfully');
    }
    //search admin by name and by email

    public function searchAdmin(serachAdmin $request){
        //dd($request->all());
        if($request->validated('name')){
            $admins = User::searchAdminByName($request->input('name'));
        }
        if($request->validated('email')){
            $admins = User::searchAdminByEmail($request->input('email'));
        }
        if($request->validated('date')){
            $admins = User::searchAdminByDate($request->input('date'));
        }
        if(!empty($admins)){
            $data['admins']=$admins;
            return view('admin.admin.list',$data);
        }else{
            return redirect()->back();
        }
    }
}

