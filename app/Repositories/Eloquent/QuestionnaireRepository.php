<?php

namespace App\Repositories\Eloquent;
use App\Models\Question;
use App\Repositories\Contracts\QuestionnaireRepositoryInterface;

class QuestionnaireRepository implements QuestionnaireRepositoryInterface
{
    private Question $question;

    public function __construct(Question $question)
    {
        $this->question = $question;
    }
    public function allWithOptions(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->question::with('options')->get();
    }

    public function allOrderedWithRank(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->question::with('options')->orderBy('question_rank', 'asc')->get();
    }

    public function allWithOptionsRecommendation(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->question::with(['options', 'options.recommendation'])->get();
    }

    public function createQuestion(array $data): Question
    {
        $question = new $this->question;
        $question->question_text = $data['question_text'];
        $question->question_rank = $data['question_rank'];
        $question->save();

        return $question;
    }

    public function updateQuestion(array $data, int $question_id): Question
    {
        $question = $this->question::find($question_id);
        $question->question_text = $data['question_text'];
        $question->question_rank = $data['question_rank'];
        $question->save();

        return $question;
    }

    public function removeQuestion(int $question_id)
    {
        return $this->question::find($question_id)->delete();
    }

}
