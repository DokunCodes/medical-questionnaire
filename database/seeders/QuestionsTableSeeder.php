<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            'Do you have difficulty getting or maintaining an erection?' => 1,
            'Have you tried any of the following treatments before?' => 2,
            'Was the Viagra or Sildenafil product you tried before effective?' => 3,
            'Was the Cialis or Tadalafil product you tried before effective?' => 4,
            'Which is your preferred treatment?' => 5,
            'Do you have, or have you ever had, any heart or neurological conditions?' => 6,
            'Do any of the listed medical conditions apply to you?' => 7,
            'Are you taking any of the following drugs?' => 8,
        ];

        foreach ($questions as $question => $rank) {
            Question::create([
                'question_text' => $question,
                'question_rank' => $rank,
            ]);
        }
    }
}
