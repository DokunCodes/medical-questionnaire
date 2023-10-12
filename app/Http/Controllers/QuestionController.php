<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Repositories\Contracts\QuestionnaireRepositoryInterface;
use Inertia\Inertia;

class QuestionController extends Controller
{
    //

    private QuestionnaireRepositoryInterface $questionnaireRepository;

    public function __construct(QuestionnaireRepositoryInterface $questionnaireRepository)
    {
        $this->questionnaireRepository = $questionnaireRepository;
    }

    public function store(QuestionRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $question = $this->questionnaireRepository->createQuestion($data);

        return response()->json(['message' => 'Question added successfully', 'status'=>true,
            'question' => $question], 201);
    }

    public function update(QuestionRequest $request, int $questionId)
    {
        try {
            $data = $request->validated();
            $updatedQuestion = $this->questionnaireRepository->updateQuestion($data,$questionId);
            return redirect()->back()->with('message', 'Question and rank updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Question not found!');
        }

    }

    public function index()
    {
        $questions = $this->questionnaireRepository->allWithOptionsRecommendation();
        return Inertia::render('Dashboard', ['questions' => $questions]);
    }

    public function destroy(int $questionId) {
        try {
            $result = $this->questionnaireRepository->removeQuestion($questionId);

            return redirect()->back()->with('message', 'Question deleted successfully');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error deleting question.');
        }


    }



}
