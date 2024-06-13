<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchTeacher;
use App\Http\Requests\TeacherRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function list(){

        $data['title'] = 'Teacher List';

        $data['teachers'] = User::getTeachers();

        return view('admin.teacher.list',$data);
    }

    public function add(){

        $data['title'] = "Add new teacher";

        $data['teacher'] = new User();

        return view('admin.teacher.add',$data);
    }

    public function store(TeacherRequest $request){


         $request->validated();
        //dd($request->all());
        $teacher = new User();
        $teacher->name = $request->name;
        $teacher->first_name = $request->first_name;
        $teacher->gender = $request->gender;
        $teacher->joining_date = $request->joining_date;
        $teacher->birth_date = $request->dob;
        $teacher->mobile_number = $request->mobile_number;
        $teacher->marital_status = $request->marital_status;
        $teacher->permanent_adress = $request->permanent_address;
        $teacher->qualification = $request->qualification;
        $teacher->work_experience = $request->work_experience;
        $teacher->note = $request->note;
        $teacher->address = $request->address;
        
        $teacher->qualification = $request->qualification;
        if(!empty($request->file('profile_pic'))){
            $text = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$text;
            $file->move('upload/image',$filename);

            $teacher->profile_pic = $filename;
        }


        $teacher->password = Hash::make($request->password);
        $teacher->status = $request->status;
        $teacher->email = $request->email;
        $teacher->is_delete = 0;
        $teacher->user_type = 2;


        $teacher->save();

        return to_route('teacher.list')->with('success','Teacher information inserted successfully');
    }

    public function modify(User $teacher){

        return view('admin.teacher.add',['teacher'=>$teacher]);
    }

    public function update(User $teacher,Request $request){
        
        $request->validate([
            'name'=>['required','string','min:2'],
            'email'=>['required','email','unique:users'],
            //'password'=>['required','min:4'],
            'first_name'=>['required','string','min:2'],
            'gender'=>['required'],
            'dob'=>['date','required'],
            'joining_date'=>['date','required'],
            'marital_status'=>['string','min:4','nullable'],
            'address'=>['required','min:4'],
            'permanent_address'=>['required','min:4'],
            'qualification'=>['string','nullable'],
            'note'=>['string','nullable'],
            'work_experience'=>['required'],
            'mobile_number'=>['required','numeric'],
            'status'=>['required'],
        ]);

        if(!empty($request->password)){
            $request->validate([
                'password'=>'required|min:4'
            ]);
            $teacher->password = Hash::make($request->password);
        }
        $teacher->name = $request->name;
        $teacher->first_name = $request->first_name;
        $teacher->gender = $request->gender;
        $teacher->joining_date = $request->joining_date;
        $teacher->birth_date = $request->dob;
        $teacher->mobile_number = $request->mobile_number;
        $teacher->marital_status = $request->marital_status;
        $teacher->permanent_adress = $request->permanent_address;
        $teacher->qualification = $request->qualification;
        $teacher->work_experience = $request->work_experience;
        $teacher->note = $request->note;
        $teacher->address = $request->address;

        if(!empty($request->file('profile_pic'))){
            $text = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$text;
            $file->move('upload/image',$filename);

            $teacher->profile_pic = $filename;
        }
        $teacher->password = Hash::make($request->password);
        $teacher->status = $request->status;
        $teacher->email = $request->email;
        $teacher->is_delete = 0;
        $teacher->user_type = 2;

        $teacher->save();

        return to_route('teacher.list')->with('success','Teacher information inserted successfully');
    }

    public function delete(User $teacher){

        if(!empty($teacher)){

        $teacher->delete();

        return to_route('teacher.list')->with('success','Teacher deleted successfully');
        }else{
            abort(404);
        }
       
    }

    public function searchteacher(SearchTeacher $request){

        $request->validated();
        
        $data['teachers'] = User::searchTeacher();

        return view('admin.teacher.list',$data);
    }
}
