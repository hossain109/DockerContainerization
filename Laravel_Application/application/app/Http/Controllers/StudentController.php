<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchStudent;
use App\Http\Requests\UserRequest;
use App\Models\Classe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function list(){

        $data['title'] = 'Student List';

        $data['students'] = User::getStudents();

        return view('admin.student.list',$data);
    }

    public function add(){

        $data['title'] = "Add new student";

        $data['classes'] = Classe::getActiveClasses();

        $data['student'] = new User();

        return view('admin.student.add',$data);
    }

    public function store(UserRequest $request){

        
        $request->validated();
        //dd($request->all());
        $student = new User();
        $student->admission_number = $request->admission_number;
        $student->roll_number = $request->roll_number;
        $student->gender = $request->gender;
        $student->name = $request->name;
        $student->first_name = $request->first_name;
        $student->admission_date = $request->admission_date;
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
        $student->password = Hash::make($request->password);
        $student->status = $request->status;
        $student->email = $request->email;
        $student->is_delete = 0;
        $student->user_type = 3;
        $student->classe_id = $request->class;

        $student->save();

        return to_route('student.list')->with('success','Student information inserted successfully');
    }

    public function modify(User $student){

        $data['classes'] = Classe::getActiveClasses();

        return view('admin.student.add',['student'=>$student],$data);
    }

    public function update(User $student,Request $request){
        
        $request->validate([
            'name'=>'required|string|min:2',
            'email'=>'required|email|unique:users',
            //'password'=>'required'|'min:4',
            'first_name'=>'required|string|min:2',
            'admission_number'=>'required',
            'roll_number'=>'required',
            'class'=>'required',
            'gender'=>'required',
            'dob'=>'required',
            'mobile_number'=>'required|numeric',
            'admission_date'=>'required',
            'profile_pic'=>'required',
            'blood_group'=>'required',
            'height'=>'required',
            'weight'=>'required',
            'status'=>'required',
        ]);
        //dd($request->all());
        if(!empty($request->password)){
            $request->validate([
                'password'=>'required|min:4'
            ]);
            $student->password = Hash::make($request->password);
        }
        $student->name = $request->name;
        $student->first_name = $request->first_name;
        $student->admission_number = $request->admission_number;
        $student->roll_number = $request->roll_number;
        $student->gender = $request->gender;
        $student->admission_date = $request->admission_date;
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
        $student->status = $request->status;
        $student->email = $request->email;
        $student->is_delete = 0;
        $student->user_type = 3;
        $student->classe_id = $request->class;

        $student->save();

        return to_route('student.list')->with('success','Student information inserted successfully');
    }

    public function delete(User $student){

        if(!empty($student)){

        $student->delete();

        return to_route('student.list')->with('success','student deleted successfully');
    }else{
        abort(404);
    }
       
    }
    //search student
    public function searchstudent(SearchStudent $request){

        $data['title'] = 'Student List';
        //dd($request->name);
        if($request->validated('name')){
        $students = User::getStudentsByName($request->input('name'));
        //dd($students);
        }

        if($request->validated('email')){
        $students = User::getStudentsByEmail($request->input('email'));
        }
       
        if($request->validated('birth_date')){
        $students = User::getStudentsByDate($request->input('birth_date'));
        }

        if($request->validated('roll_number')){
            $students = User::getStudentsByRoll($request->input('roll_number'));
            
        }
        
        if($request->validated('admission_number')){
            $students = User::getStudentsByAdmission($request->input('admission_number'));
        }
       
        if($request->validated('class_name')){
            $students = User::getStudentsByClass($request->input('class_name'));
        }

        if(!empty($students)){
            $data['students'] = $students;
            return view('admin.student.list',$data);
        }else{
            return redirect()->back();
        }
       
    }
}
