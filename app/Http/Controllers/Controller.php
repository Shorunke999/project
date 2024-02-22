<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function question(){
        $data = \App\Models\Questions::inRandomOrder(2)
        ->with('options')
        ->paginate(1);
         return new \App\Http\Resources\QuestionRecource($data[0]);
    }
    public function answerCheck(Request $request)
    {
        $emptyIdArray=[];
        $emptyAnswerArray=[];
        //$idArray = array_push($emptyIdArray,$request->each()->questionId);
         //$answerArray = array_push($emptyAnswerArray,$request->each()->answer);
        foreach($request as $aa){
            $idArray = array_push($emptyIdArray , $aa->questionId);
            $answerArray = array_push($emptyAnswerArray , $aa->answer);
            //get all the id of the request obj in idArray and answer in answerArray 
        }           
        $data =\App\Models\answer::whereIn('questionId' , $idArray)->get();
        
    }
}
