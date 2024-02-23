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
        $questionIdArray = collect($request['Answer'])->pluck('questionId');
        $dataFromDb = \App\Models\answer::whereIn('questionId',$questionIdArray)->pluck('answer');
        foreach($dataFromDb as $data){
            $request['Answer']->map(function ($array_mapped) {
                if($array_mapped == $data){
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
