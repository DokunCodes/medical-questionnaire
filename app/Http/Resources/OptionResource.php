<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ['optionId'=>$this->id, 'option'=>$this->option_text,'nextQuestionId'=>$this->next_question_id,'hasRecommendation'=>$this->recommendation_allowed ? true : false];
    }
}
