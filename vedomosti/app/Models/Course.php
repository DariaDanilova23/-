<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','Name','id_professor'
    ];
    public function professor(){
        return $this->belongsTo(Professor::class);
    }
    public function active(){
        return $this->hasMany(ActiveCourse::class);
    }
}
