<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Option::create([
            'question_id' => 1,
            'option_text' => 'Yes',
            'next_question_id' => 2,
            'recommendation_allowed' => false,
        ]);

        Option::create([
            'question_id' => 1,
            'option_text' => 'No',
            'next_question_id' => null,
            'recommendation_allowed' => false
        ]);

        Option::create([
            'question_id' => 2,
            'option_text' => 'Viagra or Sildenafil',
            'next_question_id' => 3,
            'recommendation_allowed' => false,
        ]);

        Option::create([
            'question_id' => 2,
            'option_text' => 'Cialis or Tadalafil',
            'next_question_id' => 4,
            'recommendation_allowed' => false,
        ]);

        Option::create([
            'question_id' => 2,
            'option_text' => 'Both',
            'next_question_id' => 5,
            'recommendation_allowed' => false,
        ]);

        Option::create([
            'question_id' => 2,
            'option_text' => 'None of the above',
            'next_question_id' => null,
            'recommendation_allowed' => true,
        ]);

        Option::create([
            'question_id' => 3,
            'option_text' => 'Yes',
            'next_question_id' => null,
            'recommendation_allowed' => true,
        ]);

        Option::create([
            'question_id' => 3,
            'option_text' => 'No',
            'next_question_id' => null,
            'recommendation_allowed' => true,
        ]);

        Option::create([
            'question_id' => 4,
            'option_text' => 'Yes',
            'next_question_id' => null,
            'recommendation_allowed' => true,
        ]);
        Option::create([
            'question_id' => 4,
            'option_text' => 'No',
            'next_question_id' => null,
            'recommendation_allowed' => true,
        ]);

        Option::create([
            'question_id' => 5,
            'option_text' => 'Viagra or Sildenafil',
            'next_question_id' => null,
            'recommendation_allowed' => true,
        ]);

        Option::create([
            'question_id' => 5,
            'option_text' => 'Cialis or Tadalafil',
            'next_question_id' => null,
            'recommendation_allowed' => true,
        ]);

        Option::create([
            'question_id' => 5,
            'option_text' => 'None of the above',
            'next_question_id' => null,
            'recommendation_allowed' => true,
        ]);

        Option::create([
            'question_id' => 6,
            'option_text' => 'Yes',
            'next_question_id' => 7,
            'recommendation_allowed' => true,
        ]);

        Option::create([
            'question_id' => 6,
            'option_text' => 'No',
            'next_question_id' => null,
            'recommendation_allowed' => false,
        ]);

        Option::create([
            'question_id' => 7,
            'option_text' => 'Significant liver problems (such as cirrhosis of the liver) or kidney problems',
            'next_question_id' => null,
            'recommendation_allowed' => false,
        ]);

        Option::create([
            'question_id' => 7,
            'option_text' => 'Currently prescribed GTN, Isosorbide mononitrate, Isosorbide dinitrate , Nicorandil (nitrates) or Rectogesic ointment',
            'next_question_id' => null,
            'recommendation_allowed' => false,
        ]);

        Option::create([
            'question_id' => 7,
            'option_text' => 'Abnormal blood pressure (lower than 90/50 mmHg or higher than 160/90 mmHg)',
            'next_question_id' => null,
            'recommendation_allowed' => false,
        ]);

        Option::create([
            'question_id' => 7,
            'option_text' => 'Condition affecting your penis (such as Peyronie\'s Disease, previous injuries or an inability to retract your foreskin)',
            'next_question_id' => null,
            'recommendation_allowed' => false,
        ]);

        Option::create([
            'question_id' => 7,
            'option_text' => 'I don\'t have any of these conditions',
            'next_question_id' => 8,
            'recommendation_allowed' => true,
        ]);

        Option::create([
            'question_id' => 8,
            'option_text' => 'Alpha-blocker medication such as Alfuzosin, Doxazosin, Tamsulosin, Prazosin, Terazosin or over-the-counter Flomax',
            'next_question_id' => null,
            'recommendation_allowed' => false,
        ]);

        Option::create([
            'question_id' => 8,
            'option_text' => 'Riociguat or other guanylate cyclase stimulators (for lung problems)',
            'next_question_id' => null,
            'recommendation_allowed' => false,
        ]);

        Option::create([
            'question_id' => 8,
            'option_text' => 'Saquinavir, Ritonavir or Indinavir (for HIV)',
            'next_question_id' => null,
            'recommendation_allowed' => false,
        ]);

        Option::create([
            'question_id' => 8,
            'option_text' => 'Cimetidine (for heartburn)',
            'next_question_id' => null,
            'recommendation_allowed' => false,
        ]);

        Option::create([
            'question_id' => 8,
            'option_text' => 'I don\'t take any of these drugs',
            'next_question_id' => null,
            'recommendation_allowed' => false,
        ]);
    }
}
