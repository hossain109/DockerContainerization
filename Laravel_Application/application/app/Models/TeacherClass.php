<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherClass extends Model
{
    use HasFactory;

    //count teacher and class already in database or not

    static function countAlready($user_id,$class_id){

        return self::where('user_id','=',$user_id)->where('classe_id','=',$class_id)->first();
    }

    static function tacherclasses(){

        return self::select('teacher_classes.*','classes.name as class_name','users.name as teacher_name')
                    ->join('classes','classes.id','=','teacher_classes.classe_id')
                    ->join('users','users.id','=','teacher_classes.user_id')
                    ->where('teacher_classes.status','=',1)
                    ->where('teacher_classes.is_deleted','=',0)
                    ->limit(10)
                    ->get();
    }


}
