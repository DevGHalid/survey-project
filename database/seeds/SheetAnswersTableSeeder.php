<?php

use Illuminate\Database\Seeder;

use App\Models\{Form, Sheet, TypeQuestion, SheetAnswer};

class SheetAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $form = Form::create([
        'user_id' => 1,
        'name' => 'Test form'
      ]);

      $sheet = Sheet::create([
        'user_id' => 1,
        'form_id' => $form->id,
        'title' => 'Test page 1',
        'page' => 1
      ]);

      $type_question = TypeQuestion::first();

      if (empty($type_question)) {
        $type_question = TypeQuestion::create([
          'name' => 'Короткий текст',
          'slug' => 'answer_short_text',
          'icon' => 'fe fe-file-text',
          'question' => [
            'value' => '',
            'required' => false,
            'comment' => '',
            'label' => '',
            'placeholder' => '',
            'min' => 0,
            'max' => null
          ]
        ]);
      }

      SheetAnswer::create([
        'sheet_id' => $sheet->id,
        'type_question_id' => $type_question->id,
        'answer' => $type_question->question
      ]);
    }
}
