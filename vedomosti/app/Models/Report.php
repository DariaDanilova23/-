<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','FIO','Amount','Address','PhoneNo','Salary'
    ];
    public function professor(){
        return $this->belongsTo(Professor::class);
    }
}
