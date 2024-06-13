<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use function Laravel\Prompts\search;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'classe_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    //forget password
    static public function checkMail($mail){

        return self::query()
                    ->where('users.email',"=",$mail)->first();
    }

    static public function getToken($token){
        return self::where('remember_token','=',$token)->first();
    }

    static public function getAdmins(){

        return self::select('users.*')
                    ->where('users.user_type','=',1)
                    ->orderBy('id','desc')
                    ->paginate(5)
                    ;
    }

    //search admin by name and email
    static public function searchAdminByName($name){

        return self::select('users.*')
                    ->where('name','like',"%{$name}%")
                    ->where('users.user_type','=',1)
                    ->orderBy('id','desc')
                    ->paginate(10)
                    ;
    }
    static public function searchAdminByEmail($email){

        return self::select('users.*')
                    ->where('email','like',"%{$email}%")
                    ->where('users.user_type','=',1)
                    ->orderBy('id','desc')
                    ->paginate(10)
                    ;
    }
    static public function searchAdminByDate($date){

        return self::select('users.*')
                    ->where('created_at','like',"%{$date}%")
                    ->where('users.user_type','=',1)
                    ->orderBy('id','desc')
                    ->paginate(10)
                    ;
    }
    //check current password
    static public function getDBUser($userID){

        return self::select('users.*')
                    ->where('users.id','=',$userID)
                    ->first();
    }
    //get all student
    static public function getStudents(){

        return self::select('users.*','classes.name as class_name','parent.name as parent_name')
                    ->join('users as parent','parent.id','=','users.parent_id','left')
                    ->join('classes','classes.id','=','users.classe_id')
                    ->where('users.user_type','=',3)
                    ->orderBy('id','desc')
                    ->paginate(5)
                    ;
    }
    //get students by parents
    static public function getStudentsByParent($parentId){

        return self::select('users.*','classes.name as class_name','parent.name as parent_name')
                    ->join('users as parent','parent.id','=','users.parent_id','left')
                    ->join('classes','classes.id','=','users.classe_id')
                    ->where('users.parent_id','=',$parentId)
                    ->where('users.user_type','=',3)
                    ->where('users.is_delete','=',0)
                    ->where('users.status','=',1)
                    ->orderBy('id','desc')
                    ->get();
    }

    //search student by different category
    static public function getStudentsByName($name){
                return self::select('users.*')
                ->where('name','like',"%{$name}%")
                ->where('users.user_type','=',3)
                ->where('users.status','=',1)
                ->where('users.is_delete','=',0)
                ->orderBy('id','desc')
                ->paginate(10)
                ;
    }
    static public function getStudentsByEmail($email){
        return self::select('users.*')
        ->where('email','like',"%{$email}%")
        ->where('users.user_type','=',3)
        ->where('users.status','=',1)
        ->where('users.is_delete','=',0)
        ->orderBy('id','desc')
        ->paginate(10)
        ;
    }
    static public function getStudentsByDate($date){
        return self::select('users.*')
        ->where('birth_date','like',"%{$date}%")
        ->where('users.user_type','=',3)
        ->where('users.status','=',1)
        ->where('users.is_delete','=',0)
        ->orderBy('id','desc')
        ->paginate(10)
        ;
    }
    static public function getStudentsByRoll($roll){
        return self::select('users.*')
        ->where('roll_number','like',"%{$roll}%")
        ->where('users.user_type','=',3)
        ->where('users.status','=',1)
        ->where('users.is_delete','=',0)
        ->orderBy('id','desc')
        ->paginate(10)
        ;
    }
    static public function getStudentsByAdmission($admission){
         return self::select('users.*')
        ->where('admission_number','like',"%{$admission}%")
        ->where('users.user_type','=',3)
        ->where('users.status','=',1)
        ->where('users.is_delete','=',0)
        ->orderBy('id','desc')
        ->paginate(10)
        ;
    }
    static public function getStudentsByClass($class){
        return self::select('users.*','classes.name as class_name')
        ->join('classes','classes.id','=','users.classe_id')
         ->where('classes.name','like',"%{$class}%")
        ->where('users.user_type','=',3)
        ->where('users.status','=',1)
        ->where('users.is_delete','=',0)
        ->orderBy('id','desc')
        ->paginate(10)
        ;
    }

    //get parent
    static public function getParent(){
        return self::select('users.*')
        ->where('users.user_type','=',4)
        ->where('users.status','=',1)
        ->where('users.is_delete','=',0)
        ->orderBy('id','desc')
        ->paginate(5)
        ;
    }
//search student in parent student
    static public function getSearchStudent(){

        if(!empty(Request::get('id')) || !empty(Request::get('name')) || !empty(Request::get('email')) || !empty(Request::get('mobile_number'))){
            $return = self::select('users.*','classes.name as class_name','parent.name as parent_name')
            ->join('users as parent','parent.id','=','users.parent_id','left')  //alias for parent id
            ->join('classes','classes.id','=','users.classe_id')
            ->where('users.user_type','=',3)
            ->where('users.is_delete','=',0);
            if(!empty(Request::get('id'))){
                $return  = $return->where('users.id','=',Request::get('id'));
            }
            if(!empty(Request::get('name'))){
                $return  = $return->where('users.name','like','%'.Request::get('name').'%');

            }
            if(!empty(Request::get('email'))){
                $return  = $return->where('users.email','like','%'.Request::get('email').'%');
            }
            if(!empty(Request::get('mobile_number'))){
                $return  = $return->where('users.mobile_number','like','%'.Request::get('mobile_number').'%');
            }
           $return = $return->orderBy('users.id','desc')
            ->limit(50)
            ->get()
            ;
            return $return;
        }
    }

    //get mystudents after assign
    static public function getMyStudents($parent){
        return self::select('users.*','classes.name as class_name','parent.name as parent_name')
                    ->join('users as parent','parent.id','=','users.parent_id','left')
                    ->join('classes','classes.id','=','users.classe_id')
                    ->where('users.user_type','=',3)
                    ->where('users.parent_id','=',$parent)
                    ->orderBy('id','desc')
                    ->get()
                    ;
    
    }

    //filter parent
    static public function searchParent(){
    if(!empty(Request::get('name')) || !empty(Request::get('email')) || !empty(Request::get('address')) || !empty(Request::get('mobile_number')) || !empty(Request::get('occupation'))){
        $return = self::select('users.*')
                ->where('users.user_type','=',4)
                ->where('users.status','=',1)
                ->where('users.is_delete','=',0);
                
                if(!empty(Request::get('name'))){
                    $return  = $return->where('name','like','%'.Request::get('name').'%');
                }
                if(!empty(Request::get('email'))){
                    $return  = $return->where('email','like','%'.Request::get('email').'%');
                }
                if(!empty(Request::get('address'))){
                    $return  = $return->where('address','like','%'.Request::get('address').'%');
                }
                if(!empty(Request::get('mobile_number'))){
                    $return  = $return->where('mobile_number','like','%'.Request::get('mobile_number').'%');
                }
                if(!empty(Request::get('occupation'))){
                    $return  = $return->where('occupation','like','%'.Request::get('occupation').'%');
                }
            $return = $return->orderBy('users.id','desc')
            ->limit(50)
            ->get()
            ;
            return $return;
        }
    }
    //teacher function
    static public function getTeachers(){
        return self::select('users.*')
                    ->where('users.user_type','=',2)
                    ->where('users.status','=',1)
                    ->where('users.is_delete','=',0)
                    ->orderBy('id','desc')
                    ->paginate(5)
                ;
    }

    //search teacher
    static public function searchTeacher(){
        $return = self::select('users.*')
                ->where('users.user_type','=',2)
                ->where('users.status','=',1)
                ->where('users.is_delete','=',0);
                if(!empty(Request::get('name'))){
                    $return  = $return->where('name','like','%'.Request::get('name').'%');
                }
                if(!empty(Request::get('email'))){
                    $return  = $return->where('email','like','%'.Request::get('email').'%');
                }
                if(!empty(Request::get('joining_date'))){
                    $return  = $return->where('joining_date','like','%'.Request::get('joining_date').'%');
                }
                if(!empty(Request::get('mobile_number'))){
                    $return  = $return->where('mobile_number','like','%'.Request::get('mobile_number').'%');
                }
            $return = $return->orderBy('users.id','desc')
                    ->limit(50)
                    ->get();
            return $return;
    }
}