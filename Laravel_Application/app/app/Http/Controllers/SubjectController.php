<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchSubject;
use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function list(){

        $data['title']="Subject List";

        $subjects = Subject::getSubjects();

        $data['subjects']=$subjects;

        return view('admin.subject.list',$data);
    }
    public function add(){

        $data['subject'] = new Subject();

        $data['title']='Add Subject';

        return view('admin.subject.add',$data);
    }
    public function store(SubjectRequest $request){
        $request->validated();
        $subject = new Subject();
        $subject->name = $request->name;
        $subject->status = $request->status;
        $subject->type = $request->type;
        $subject->createdBy=Auth::user()->id;
        $subject->is_deleted = 0;

        $subject->save();

        return redirect('admin/subject/list')->with('success',"data inserted successfully");
    }

    public function modify(Subject $subject){

        $data['title']="Subject Modify";

        return view('admin.subject.add',['subject'=>$subject],$data);
    }
    public function update(SubjectRequest $request,Subject $subject){
        // $request->validate([
        //     'name'=>'required|string|min:2',
        //     'email'=>'required|email|unique:users',
        // ]);
        $request->validated();
        $subject->name = $request->name;
        $subject->status = $request->status;
        $subject->type = $request->type;
        $subject->createdBy=Auth::user()->id;
        $subject->is_deleted = 0;
        $subject->save();
        return to_route('subject.list')->with('success',"data updated successfully");
        
    }

    public function delete(Subject $subject){

        $subject->delete();
        return redirect('admin/subject/list')->with('success','class deleted with successfully');
    }
    //search admin by name and by email

    public function searchSubject(SearchSubject $request){

        if($request->validated('name')){
            $subjects = Subject::searchSubjectByName($request->input('name'));
        }

        if($request->validated('type')){
            $subjects = Subject::searchSubjectByType($request->input('type'));
        }
        if($request->validated('date')){
            $subjects = Subject::searchSubjectByDate($request->input('date'));
        }
        if(!empty($subjects)){
            $data['subjects']=$subjects;
            return view('admin.subject.list',$data);
        }else{
            return redirect()->back();
        }
    }
}
