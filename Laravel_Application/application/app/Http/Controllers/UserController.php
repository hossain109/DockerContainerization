<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //change password for teacher,student,parent
    public function changePassword(){

        $data['title'] = "Teacher Change Password";

        return view('teacher.add',$data);
    }
    public function submitPassword(ChangePassword $request){
       
        $request->validated();

        $user = User::getDBUser(Auth::user()->id);
        
        if(Hash::check($request->current,$user->password)){

            $currentpassword = Hash::make($request->new);

            $user->password = $currentpassword;

            
           $user->save();

           return redirect()->back()->with('success','Password successfully updated');
        }
        else{
            return redirect()->back()->with('error','Old password not match with current pasword');
        }

    }
    //my account for amdin
    public function myAccountAdmin(){

        $admin =User::getDBUser(Auth::user()->id);

        $data['title'] = "Admin List";

        return view('admin.admin.my-account',$data,['admin'=>$admin]);
    }

    public function updateMyAccountAdmin(Request $request){

        $request->validate([
            'name'=>['required','string'],
            'email'=>['required','email']
        ]);
        
        $admin =User::getDBUser(Auth::user()->id);

        $admin->name = $request->name;
        $admin->email = $request->email;

        $admin->save();

        return redirect()->back()->with('success','Admin updatted succesfully');


    }

    //my account for teacher
    public  function myAccountTeacher(){

        $teacher =User::getDBUser(Auth::user()->id);

        $data['title'] = "Teacher List";

        return view('teacher.my-account',$data,['teacher'=>$teacher]);
    }
    public function updateMyAccountTeacher(Request $request){

            $request->validate([
            'name'=>['required','string','min:2'],
            'email'=>['required','email','unique:users'],
            //'password'=>['required','min:4'],
            'first_name'=>['required','string','min:2'],
            'gender'=>['required'],
            'dob'=>['date','required'],
            //'joining_date'=>['date','required'],
            'marital_status'=>['string','min:4','nullable'],
            'address'=>['required','min:4'],
            'permanent_address'=>['required','min:4'],
            'qualification'=>['string','nullable'],
            //'note'=>['string','nullable'],
            'work_experience'=>['required'],
            'mobile_number'=>['required','numeric','min:9','max:11'],
        ]);

        $teacher = User::getDBUser(Auth::user()->id);

        $teacher->name = $request->name;
        $teacher->first_name = $request->first_name;
        $teacher->gender = $request->gender;
       // $teacher->joining_date = $request->joining_date;
        $teacher->birth_date = $request->dob;
        $teacher->mobile_number = $request->mobile_number;
        $teacher->marital_status = $request->marital_status;
        $teacher->permanent_adress = $request->permanent_address;
        $teacher->qualification = $request->qualification;
        $teacher->work_experience = $request->work_experience;
        //$teacher->note = $request->note;
        $teacher->address = $request->address;

        if(!empty($request->file('profile_pic'))){
            $text = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$text;
            $file->move('upload/image',$filename);

            $teacher->profile_pic = $filename;
        }

        $teacher->email = $request->email;


        $teacher->save();

        return redirect()->back()->with('success','Teacher information inserted successfully');
    }
        //my account for student
        public  function myAccountStudent(){

            $data['title'] = "Student List";

            $student =User::getDBUser(Auth::user()->id);
    
            return view('student.my-account',$data,['student'=>$student]);
        }
        public function updateMyAccountStudent(Request $request){
    
            $request->validate([
                'name'=>'required|string|min:2',
                'email'=>'required|email|unique:users',
                'first_name'=>'required|string|min:2',
                'gender'=>'required',
                'dob'=>'required',
                'mobile_number'=>'required|numeric',
               // 'profile_pic'=>'required',
                'blood_group'=>'required',
                'height'=>'required',
                'weight'=>'required',
            ]);

            $student = User::getDBUser(Auth::user()->id);

            $student->name = $request->name;
            $student->first_name = $request->first_name;
            $student->gender = $request->gender;
            $student->birth_date = $request->dob;
            $student->mobile_number = $request->mobile_number;
    
            if(!empty($request->file('profile_pic'))){
                $text = $request->file('profile_pic')->getClientOriginalExtension();
                $file = $request->file('profile_pic');
                $randomStr = Str::random(20);
                $filename = strtolower($randomStr).'.'.$text;
                $file->move('upload/image',$filename);
    
                $student->profile_pic = $filename;
            }
    
            $student->blood_group = $request->blood_group;
            $student->height = $request->height;
            $student->weight = $request->weight;
            $student->email = $request->email;

    
            $student->save();
    
            return redirect()->back()->with('success','Teacher information inserted successfully');
        }
    //my account for parent
    public  function myAccountParent(){

        $data['title'] = "Parent List";

        $parent =User::getDBUser(Auth::user()->id);

        return view('parent.my-account',$data,['parent'=>$parent]);
    }
    public function updateMyAccountParent(Request $request){

        $request->validate([
            'name'=>'required|string|min:2',
            'email'=>'required|email|unique:users',
            'first_name'=>'required|string|min:2',
            'gender'=>'required',
            'occupation'=>'required|string',
            'address'=>'required|string',
            'mobile_number'=>'required|numeric',
        ]);

        $parent = User::getDBUser(Auth::user()->id);
        //dd($request->all());
        if(!empty($request->password)){
            $request->validate([
                'password'=>'required|min:4'
            ]);
            $parent->password = Hash::make($request->password);
        }
        $parent->name = $request->name;
        $parent->first_name = $request->first_name;
        $parent->gender = $request->gender;
        $parent->occupation = $request->occupation;
        $parent->address = $request->address;
        $parent->mobile_number = $request->mobile_number;

        if(!empty($request->file('profile_pic'))){
            $text = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$text;
            $file->move('upload/image',$filename);

            $parent->profile_pic = $filename;
        }

        $parent->email = $request->email;

        $parent->save();

        return redirect()->back()->with('success','Teacher information inserted successfully');
    }
    //parent my-student
    public function parentStudent(){

        $data['parent'] = Auth::user();

        //dd($data['parent']);

        $data['mystudents'] = User::getStudentsByParent(Auth::user()->id);

        return view('parent.my-student',$data);
    }
}
