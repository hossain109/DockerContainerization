<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\TeacherClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherClassController extends Controller
{
    public function list(){

        $data['title'] = "Teacher Class assign";

        $data['teacherclasses'] = TeacherClass::tacherclasses();

        return view('admin.teacherclass_assign.list',$data);
    }

    public function add(){

        $data['title'] = "Assign Teacher Class";

        $data['classes'] = Classe::getActiveClasses();

        $data['teachers']  = User::getTeachers();

        $data['teacherclass'] = new TeacherClass();

        return view('admin.teacherclass_assign.add',$data);
    }

    public function store(Request $request){

            if(!empty($request->user_id)){

                foreach ($request->user_id as $value) {
                    $countAlready = TeacherClass::countAlready($value,$request->class_id);
           
                    if(!empty($countAlready)){
                       // dd($countAlready);
                        $countAlready->status = $request->status;
                        $countAlready->save();
                    }else{
                        $teacherclass = new TeacherClass();
                        $teacherclass->classe_id = $request->class_id;
                        $teacherclass->status = $request->status;
                        $teacherclass->is_deleted = 0;
                        $teacherclass->user_id = $value;
                        $teacherclass->createdBy = Auth::user()->id;
                        $teacherclass->save();
                    }

                }
                return redirect('admin/teacher-class/list')->with('success',"Teacher successfully assigned");

            }else{
                return redirect()->with('error', 'Due to some error pls try again later');
            }



           

    }

    public function modify(TeacherClass $teacherclass){

        $data['classes'] = Classe::getActiveClasses();

        $data['teacherclass'] = $teacherclass;

        $data['teachers']  = User::getTeachers();

      //////  $data['teacherclass'] = ;

        return view('admin.teacherclass_assign.add',$data);
    }

    public function update(TeacherClass $teacherClass,Request $request){

    }
    public function delete(TeacherClass $teacherClass){

    }
}
