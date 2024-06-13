<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectClass;
use App\Models\Classe;
use App\Models\Subject;
use App\Models\Subject_assign_class;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectClassController extends Controller
{
    public function list(){

        $data['title']="Sub List";

        $subclasses = Subject_assign_class::getSubClasses();
       //dd($subclasses[0]->subject);
        $data['subclasses']=$subclasses;

        return view('admin.subclass_assign.list',$data);
    }
    public function add(){

        $data['subclass'] = new Subject_assign_class();

        $data['classes'] = Classe::getActiveClasses();
        
        $data['subjects'] = Subject::getActiveSubjects();

        $data['title']='Add Subject Class';

        return view('admin.subclass_assign.add',$data);
    }
    public function store(SubjectClass $request){
        //dd($request->all());
        $request->validated();
        if(!empty($request->subject_id)){
           foreach ($request->subject_id as $value) {
            $countAlready = Subject_assign_class::countAlready($value,$request->class_id);
            if(!empty($countAlready)){
                $countAlready->status = $request->status;
                $countAlready->save();
            }else{
            $subclass = new Subject_assign_class();
            $subclass->classe_id = $request->class_id;
            $subclass->status = $request->status;
            $subclass->createdBy = Auth::user()->id;
            $subclass->is_deleted = 0;
            $subclass->subject_id = $value;
            $subclass->save();
                }
           }
           return redirect('admin/subject-class/list')->with('success',"Subject successfully assigned");
        }else{
            return redirect()->with('error', 'Due to some error pls try again later');
        }

    }

    public function modify(Subject_assign_class $subclass){

        $data['title']="Subjecrt Class Modify";

        $data['classes'] = Classe::getActiveClasses();
        
        $data['subjects'] = Subject::getActiveSubjects();

        return view('admin.subclass_assign.add',['subclass'=>$subclass],$data);
    }
    public function update(SubjectClass $request,Subject_assign_class $subclass){

        $request->validated();

       $deleteAllSubjects = Subject_assign_class::deleteAllSubjects($subclass->classe_id);
        //dd($subclass);
        if(!empty($request->subject_id)){
           foreach ($request->subject_id as $value) {
            $countAlready = Subject_assign_class::countAlready($value,$request->class_id);
            if(!empty($countAlready)){
                $countAlready->status = $request->status;
                $countAlready->save();
            }else{
            $subclass = new Subject_assign_class();
            $subclass->classe_id = $request->class_id;
            $subclass->status = $request->status;
            $subclass->createdBy = Auth::user()->id;
            $subclass->is_deleted = 0;
            $subclass->subject_id = $value;
            $subclass->save();
                }
           }
           return to_route('subclass.list')->with('success',"data updated successfully");
        }else{
            return redirect()->with('error', 'Due to some error pls try again later');
        }
        // return to_route('subclass.list')->with('success',"data updated successfully");
        
    }

    public function delete(Subject_assign_class $subclass){

        $subclass->delete();
        return redirect('admin/subject-class/list')->with('success','Subject class assigned deleted with successfully');
    }
    //search admin by name and by email

    public function searchClass(Request $request){
        //dd($request->all());
        if($request->validated('name')){
            $classes = Subject_assign_class::searchClassByName($request->input('name'));
        }

        if($request->validated('date')){
            $classes = Subject_assign_class::searchClassByDate($request->input('date'));
        }
        if(!empty($classes)){
            $data['classes']=$classes;
            return view('admin.class.list',$data);
        }else{
            return redirect()->back();
        }
    }
}
