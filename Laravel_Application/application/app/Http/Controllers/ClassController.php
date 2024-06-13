<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassRequest;
use App\Http\Requests\SearchClass;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function list(){

        $data['title']="Class List";

        $classes = Classe::getClasses();

        $data['classes']=$classes;

        return view('admin.class.list',$data);
    }
    public function add(){

        $data['class'] = new Classe();

        $data['title']='Add Class';

        return view('admin.class.add',$data);
    }
    public function store(ClassRequest $request){
        $request->validated();
        $class = new Classe();
        $class->name = $request->name;
        $class->status = $request->status;
        $class->user_id=Auth::user()->id;
        $class->is_deleted = 0;

        $class->save();

        return redirect('admin/class/list')->with('success',"data inserted successfully");
    }

    public function modify(Classe $class){
        $data['title']="Class Modify";
        return view('admin.class.add',['class'=>$class],$data);
    }
    public function update(ClassRequest $request,Classe $class){
        // $request->validate([
        //     'name'=>'required|string|min:2',
        //     'email'=>'required|email|unique:users',
        // ]);

       
        $request->validated();
        $class->name = $request->name;
        $class->status = $request->status;
        $class->user_id=Auth::user()->id;
        $class->is_deleted = 0;
        $class->save();
        return to_route('class.list')->with('success',"data updated successfully");
        
    }

    public function delete(Classe $class){

        $class->delete();
        return redirect('admin/class/list')->with('success','class deleted with successfully');
    }
    //search admin by name and by email

    public function searchClass(SearchClass $request){
        //dd($request->all());
        if($request->validated('name')){
            $classes = Classe::searchClassByName($request->input('name'));
        }

        if($request->validated('date')){
            $classes = Classe::searchClassByDate($request->input('date'));
        }
        if(!empty($classes)){
            $data['classes']=$classes;
            return view('admin.class.list',$data);
        }else{
            return redirect()->back();
        }
    }
}