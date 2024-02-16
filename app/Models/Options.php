<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    use HasFactory;
    public function questions(){
        return $this->belongsTo(\App\Models\questions::class,'questionId');
    }
}
