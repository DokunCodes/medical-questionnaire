<?php

namespace App\Repositories\Contracts;

use App\Models\Question;

interface QuestionnaireRepositoryInterface
{
    public function __construct(Question $question);
    public function allWithOptions();
    public function allOrderedWithRank();
    public function createQuestion(array $data): Question;
    public function updateQuestion(array $data, int $question_id): Question;
    public function removeQuestion(int $question_id);
}
