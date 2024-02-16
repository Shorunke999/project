<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    public function options(){
        return $this->hasMany(\App\Models\options::class,'questionId');
    }
    public function answer(){
        return $this->hasMany(\App\Models\answer::class,'questionId');
    }
}
