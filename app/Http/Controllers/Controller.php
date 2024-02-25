<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function question(){
        $data = \App\Models\Questions::inRandomOrder(2)//change to number of 
        ->with('options')
        ->paginate(1);
         return new \App\Http\Resources\QuestionRecource($data[0]);
    }
    public function answerCheck(Request $request)
    {
        /* e.g of data/Request from front end 
        answerArray:[{"questionId":2,"answer":"all of the above"},
        {"questionId":1,"answer":"all of the above"}]*/
        $questionIdArray = collect($request->Answer)->pluck('questionId');//get questionId in form of array for use in the db
        $dataFromDb = \App\Models\answer::whereIn('questionId',$questionIdArray)->pluck('answer');//get answer in array
        $score = 0;
        //loop through the answer from db
        foreach($dataFromDb as $data){
            //map through the re
            $request->Answer->map(function ($array_mapped) {
                if($array_mapped->answer == $data){
                    $score = $score + 1;
                }
            });
        }
        $scorePercent = ($score / 10) * 100;
        return response([
            'score' => $scorePercent
        ]);
    }
}
