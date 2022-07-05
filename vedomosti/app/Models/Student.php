<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','FIO','Address','PhoneNo','email','ReportCardNo'
    ];
    public function active(){
        return $this->hasMany(ActiveCourse::class);
    }
}
