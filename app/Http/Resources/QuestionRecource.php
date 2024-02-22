<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionRecource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'question'=>$this->question,
            'answer'=>$this->answer,
            'options'=>[
                
                [
                    'id'=>$this->options[0]['id'],
                    'option'=>$this->options[0]['option']
                ],
                [
                    'id'=>$this->options[1]['id'],
                    'option'=>$this->options[1]['option']
                ],
                [
                    'id'=>$this->options[2]['id'],
                    'option'=>$this->options[2]['option']
                ],
                [
                    'id'=>$this->options[3]['id'],
                    'option'=>$this->options[3]['option']
                ],
            ]
        ];
    }
}
