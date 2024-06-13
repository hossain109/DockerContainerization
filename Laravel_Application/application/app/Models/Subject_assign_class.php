<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject_assign_class extends Model
{
    use HasFactory;

    protected $table = "subject_assign_class";

    static public function getSubClasses(){
        return self::select('subject_assign_class.*','users.name as createdBy')
                    ->join('users','users.id','=','subject_assign_class.createdBy')
                    ->where('subject_assign_class.is_deleted','=',0)
                    // ->where('subject_assign_class.status','=',1)
                    ->orderBy('id','desc')
                    ->paginate(8);
    }

    //check data already inserted or not
    static public function countAlready($subject_id,$class_id,){

        return self:: where('classe_id','=',$class_id)-> where('subject_id','=',$subject_id)->first();
    }

    //delete all subject by class for update
    static public function deleteAllSubjects($class_id){
        return self::where('subject_assign_class.classe_id','=',$class_id)->delete();
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function classe(){
        return $this->belongsTo(Classe::class);
    }
}
