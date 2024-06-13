<?php
namespace App\Http\Controllers;

use App\Http\Requests\ParentRequest;
use App\Http\Requests\SearchParent;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ParentController extends Controller
{
    public function list(){

        $data['title']="Parent List";

        $parents = User::getParent();

        $data['parents']=$parents;

        return view('admin.parent.list',$data);
    }
    public function add(){

        $data['parent'] = new User();

        $data['title']='Add Parent';

        return view('admin.parent.add',$data);
    }
    public function store(ParentRequest $request){
        $request->validated();
        //dd($request->all());
        $parent = new User();

        $parent->name = $request->name;
        $parent->first_name = $request->first_name;
        $parent->gender = $request->gender;
        $parent->mobile_number = $request->mobile_number;

        if(!empty($request->file('profile_pic'))){
            $text = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$text;
            $file->move('upload/image',$filename);

            $parent->profile_pic = $filename;
        }
        $parent->address = $request->address;
        $parent->occupation = $request->occupation;
        $parent->password = Hash::make($request->password);
        $parent->status = $request->status;
        $parent->email = $request->email;
        $parent->is_delete = 0;
        $parent->status = $request->status;
        $parent->user_type = 4;


        $parent->save();

        return redirect('admin/parent/list')->with('success',"data inserted successfully");
    }

    public function modify(User $parent){

        $data['title']="Parent Modify";

        return view('admin.parent.add',['parent'=>$parent],$data);
    }
    public function update(Request $request,User $parent){
        $request->validate([
            'name'=>'required|string|min:2',
            'email'=>'required|email|unique:users',
            'first_name'=>'required|string|min:2',
            'gender'=>'required',
            'occupation'=>'required|string',
            'address'=>'required|string',
            'mobile_number'=>'required|numeric',
            'status'=>'required',
        ]);
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

        $parent->status = $request->status;
        $parent->email = $request->email;
        $parent->is_delete = 0;
        $parent->user_type = 4;


        $parent->save();

        return to_route('parent.list')->with('success',"data updated successfully");
        
    }

    public function delete(User $parent){

        $parent->delete();

        return redirect('admin/parent/list')->with('success','class deleted with successfully');
    }
    //search admin by name and by email

    public function searchParent(SearchParent $request){
        if(!empty($request->validated('name')) || !empty($request->validated('email')) || !empty($request->validated('mobile_number')) || !empty($request->validated('occupation')) || !empty($request->validated('occupation'))){
            $parents = User::searchParent();

        }        

        if(!empty($parents)){
            $data['parents']=$parents;
            return view('admin.parent.list',$data);
        }else{
            return redirect()->back();
        }
    }
    //search student in parent student assign
    public function mystudent(User $parent){
        
        $data['parent'] = $parent;

        $data['header'] = "¨Parent student list";

        $data['students'] = User::getSearchStudent();

        $data['mystudents'] = User::getMyStudents($parent->id);

        return view('admin.parent.parent_student',$data);
    }
    //assign student to parents
    public function parentassign(User $student,User $parent){
      
        $student->parent_id = $parent->id;
        
        $student->save();

        return back()->with('success',"Student successfully assingn");

    }
    //delete parent student assign delete
    public function parentStudentDelete(User $student){

        $student->delete();
        return redirect()->back()->with('success','Student deleted successfully');
    }
}
