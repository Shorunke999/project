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
        
        /*e.g of data/Request from front end 
        answerArray:[{"questionId":2,"answer":"all of the above"},
        {"questionId":1,"answer":"all of the above"}],*/
        $answerArray = $request->answerArray;
    
        // Extract question ids from the answerArray
        $questionIds = collect($answerArray)->pluck('questionId');
    
        // Fetch answers from the database for the given questionIds
        $answersFromDb = \App\Models\Answer::whereIn('questionId', $questionIds)->pluck('answer', 'questionId');
    
        $score = 0;
    
        foreach ($answerArray as $answer) {
            $questionId = $answer['questionId'];
            $userAnswer = $answer['answer'];
    
            if ($answersFromDb->has($questionId)) {
                $correctAnswer = $answersFromDb[answer];// $answersFromDb[$questionId];
                if ($userAnswer === $correctAnswer) {
                    $score++;
                }
            }
        }
    
        $totalQuestions = count($answerArray);
        $scorePercent = ($score / $totalQuestions) * 100;
        response()->json([
           'score' => $scorePercent
        ]);
    }
}
