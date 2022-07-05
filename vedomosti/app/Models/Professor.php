<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','FIO','Address','PhoneNo','Salary'
    ];
    public function course(){
        return $this->hasMany(Course::class);
    }
}
