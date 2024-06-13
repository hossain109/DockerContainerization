<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = ['name','status'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    static public function getClasses(){
        return self::select('classes.*','users.name as createdBy')
                    ->join('users','users.id','=','classes.user_id')
                    //->where('classes.status','=',1)
                    ->where('classes.is_deleted','=',0)
                    ->orderBy('id','desc')
                    ->paginate(10)
                    ;
    }

        //search class by name and email
        static public function searchClassByName($name){

            return self::select('classes.*','users.name as createdBy')
                        ->join('users','users.id','=','classes.user_id')
                        ->where('classes.status','=',1)
                        ->where('classes.is_deleted','=',0)
                        ->where('classes.name','like',"%{$name}%")
                        ->orderBy('id','desc')
                        ->paginate(10)
                        ;
        }
        static public function searchClassByDate($date){
    
            return self::select('classes.*','users.name as createdBy')
                        ->join('users','users.id','=','classes.user_id')
                        ->where('classes.status','=',1)
                        ->where('classes.is_deleted','=',0)
                        ->where('classes.created_at','like',"%{$date}%")
                        ->orderBy('id','desc')
                        ->paginate(10)
                        ;
        }

        //get active class for assign
        static public function getActiveClasses(){
            return self::select('classes.*')
                        ->join('users','users.id','=','classes.user_id')
                        ->where('classes.status','=',1)
                        ->where('classes.is_deleted','=',0)
                        ->orderBy('id','desc')
                        ->get()
                        ;
        }

        //can may subject be assign
        public function getAssignSub(){
            return $this->hasMany(Subject_assign_class::class);
        }
           //can may subject be assign
        public function getAssignTeacher(){
            return $this->hasMany(User::class);
       }
}
