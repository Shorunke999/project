<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function question(){
        $data = \App\Models\Questions::inRandomOrder(2)->with('options')->paginate(1);
         return  new \App\Http\Resources\QuestionRecource($data[0]);
    }
}
