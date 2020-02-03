<?php

use Illuminate\Database\Seeder;

use App\Models\TypeQuestion;

class TypeQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $questions = [
        [
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
        ],
        [
          'name' => 'Длинный текст',
          'slug' => 'answer_long_text',
          'icon' => 'fe fe-book-open',
          'question' => [
            'value' => '',
            'required' => false,
            'comment' => '',
            'label' => '',
            'placeholder' => '',
            'min' => 0,
            'max' => null
          ]
        ],
        [
          'name' => 'Выпадающий список',
          'slug' => 'answer_choices',
          'icon' => 'fe fe-list',
          'question' => [
            'value' => '',
            'required' => false,
            'comment' => '',
            'label' => '',
            'placeholder' => '',
            'options' => []
          ]
        ],
        [
          'name' => 'Один вариант',
          'slug' => 'answer_choices',
          'icon' => 'fe fe-toggle-left',
          'question' => [
            'value' => '',
            'required' => false,
            'comment' => '',
            'label' => '',
            'placeholder' => ''
          ]
        ],
        [
          'name' => 'Несколько вариантов',
          'slug' => 'answer_choices',
          'icon' => 'fe fe-check-square',
          'question' => [
            'value' => [],
            'required' => false,
            'comment' => '',
            'label' => '',
            'placeholder' => ''
          ]
        ],
        [
          'name' => 'Почта',
          'slug' => 'email',
          'icon' => 'fe fe-mail',
          'question' => [
            'value' => [],
            'required' => false,
            'comment' => '',
            'label' => '',
            'placeholder' => ''
          ]
        ],
        [
          'name' => 'Файл',
          'slug' => 'file',
          'icon' => 'fe fe-file',
          'question' => [
            'extensions' => [],
            'value' => [],
            'required' => false,
            'comment' => '',
            'label' => '',
            'placeholder' => ''
          ]
        ]
      ];

      foreach ($questions as $question) {
        TypeQuestion::create([
          'name' => $question['name'],
          'slug' => $question['slug'],
          'icon' => $question['icon'],
          'question' => $question['question']
        ]);
      }
    }
}
