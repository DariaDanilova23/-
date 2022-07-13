<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveCourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','id_student','id_course','grade'
    ];
    protected $casts=[
    'grade'=>'array'
    ];
    public function student(){
        return $this->belongsTo(Student::class,'id_student','id');
    }
    public function course(){
        return $this->belongsTo(Course::class,'id_course','id');
    }
    public function average($id){
        $mark=0;
        $amount=0;
            $mark+=array_sum($id['grade']);
            $amount+=count($id['grade']);
        if($amount==0) return 0;
        else return $mark/$amount ;
    }
    public function best($id){
        $max='';
        $id_student=array();
        foreach ($id as $item){
            $findMax=$this->average($item);
           if($findMax>=$max){
               if($findMax>$max){ unset($id_student);}
                $max=$findMax;
               $id_student[]=$item['id_student'];
            }
        }
        return $id_student;
    }
}
