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
}
