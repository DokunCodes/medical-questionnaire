<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionnaireResource;
use App\Models\Option;
use App\Models\Question;
use App\Models\Recommendation;
use App\Repositories\Contracts\QuestionnaireRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    protected QuestionnaireRepositoryInterface $questionnaireRepository;

    public function __construct(QuestionnaireRepositoryInterface $questionnaireRepository)
    {
        $this->questionnaireRepository = $questionnaireRepository;
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        $questions = $this->questionnaireRepository->allOrderedWithRank();
       return response()->json(['message' => 'Questionnaire','status' => true, 'data'=>QuestionnaireResource::collection($questions)], 200);
    }

    public function save(Request $request) {
        try {
            $question = Question::create(['question_text' => $request->input('question_text'), 'question_rank' => $request->input('question_rank')]);

            foreach ($request->input('options') as $optionData) {
                $option = Option::create([
                    'option_text' => $optionData['text'],
                    'question_id' => $question->id,
                    'next_question_id' => $optionData['next_question_id'] ?? null,
                    'recommendation_allowed' => (bool)$optionData['recommendation']
                ]);

                if($optionData['recommendation']){
                    Recommendation::create([
                        'option_id' => $option->id,
                        'product_id' => $optionData['recommendation']
                    ]);
                }
            }

            return redirect()->back()->with('message', 'Question and options added!');
        }
        catch (QueryException $e){
            return redirect()->back()->with('error', 'The ranking number already exist. Please try an unused number.');
        }
        catch (\Exception $e){
            return redirect()->back()->with('error', 'There was an error creating the question. ' . $e->getMessage());
        }

    }
}
