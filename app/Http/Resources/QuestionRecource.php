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
                'option_1'=>$this->options[0]['option_1'],
                'option_2'=>$this->options[0]['option_2'],
                'option_3'=>$this->options[0]['option_3'],
                'option_4'=>$this->options[0]['option_4'],
            ]
        ];
    }
}
