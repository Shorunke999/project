<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function question(){
        $data = \App\Models\Questions::inRandomOrder(1)//change to number of 
        ->with('options')
        ->paginate(1);
         return new \App\Http\Resources\QuestionRecource($data[0]);
    }
    public function answerCheck(Request $request)
    {
        // Get the answerArray from the request
        $answerArray = $request->json()->all();

        // Extract question ids and user answers from the answerArray
        $questionIds = collect($answerArray)->pluck('questionId');
        $userAnswers = collect($answerArray)->pluck('answer');

        // Fetch answers from the database for the given questionIds
        $answersFromDb = \App\Models\Answer::whereIn('questionId', $questionIds)->pluck('answer', 'questionId');

        $score = 0;
        // Compare user answers with the correct answers
        foreach ($answerArray as $answer) {
            // Check if the answer exists in the database
            if ($answersFromDb->has($answer['questionId'])) {
                // Get the correct answer from the database
                $correctAnswer = $answersFromDb[$answer['questionId']];
                
                // Check if the user's answer matches the correct answer
                if ($answer['answer'] === $correctAnswer) {
                    $score++; // Increment score if the answer is correct
                }
            }
        }

        // Return the score
        return response()->json(['score' => ($score/count($answerArray)* 100). '%']);
    }

}
