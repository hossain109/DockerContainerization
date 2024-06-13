<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name','type','status'];

    static public function getSubjects(){
            return self::select('subjects.*','users.name as createdBy')
                        ->join('users','users.id','=','subjects.createdBy')
                        //->where('classes.status','=',1)
                        ->where('subjects.is_deleted','=',0)
                        ->orderBy('id','desc')
                        ->paginate(10)
                        ;
    }

            //search subject by name and email
            static public function searchSubjectByName($name){

                return self::select('subjects.*','users.name as createdBy')
                            ->join('users','users.id','=','subjects.createdBy')
                            ->where('subjects.status','=',1)
                            ->where('subjects.is_deleted','=',0)
                            ->where('subjects.name','like',"%{$name}%")
                            ->orderBy('id','desc')
                            ->paginate(10)
                            ;
            }
            static public function searchSubjectByDate($date){
        
                return self::select('subjects.*','users.name as createdBy')
                            ->join('users','users.id','=','subjects.createdBy')
                            ->where('subjects.status','=',1)
                            ->where('subjects.is_deleted','=',0)
                            ->where('subjects.created_at','like',"%{$date}%")
                            ->orderBy('id','desc')
                            ->paginate(10)
                            ;
            }
            static public function  searchSubjectByType($type){
        
                return self::select('subjects.*','users.name as createdBy')
                            ->join('users','users.id','=','subjects.createdBy')
                            ->where('subjects.status','=',1)
                            ->where('subjects.is_deleted','=',0)
                            ->where('subjects.type','like',"%{$type}%")
                            ->orderBy('id','desc')
                            ->paginate(10)
                            ;
            }

            //get active subjects
            static public function getActiveSubjects(){
                return self::select('subjects.*')
                            ->join('users','users.id','=','subjects.createdBy')
                            ->where('subjects.status','=',1)
                            ->where('subjects.is_deleted','=',0)
                            ->orderBy('id','desc')
                            ->get();
                            ;
        }
           

}
