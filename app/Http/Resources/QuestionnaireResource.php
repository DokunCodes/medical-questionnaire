<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionnaireResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ['questionId'=>$this->id, 'question'=>$this->question_text,'rank'=>$this->question_rank, 'options'=>OptionResource::collection($this->options)];
    }


}
