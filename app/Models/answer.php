<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Questions;

class answer extends Model
{
    use HasFactory;
    public function question(){
        $this->belongsTo(Questions::class,'questionId');
    }
}
