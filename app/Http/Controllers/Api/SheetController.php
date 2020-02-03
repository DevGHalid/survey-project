<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SheetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }   

    public function create(Request $request)
    {
        $user = Auth::user();

        // load form or fail
        $form = Form::findOrFail($request->form_id);

        // checking on permission
        if (!$user->can('create', $form)) {
            return abort(403);
        }

        // create a new sheet for the form
        $sheet = $form->sheets()->create([
            'user_id' => $user->id,
            'title' => $request->title,
            'page' => $request->page ?? 1
        ]);

        $sheet->load('sheetAnswers:sheet_answers.id,sheet_answers.sheet_id,sheet_answers.type_question_id,sheet_answers.answer');

        return response()->json([
            'success' => true,
            'sheet' => $sheet
        ]);
    }

    public function update(Request $request): object
    {
        if (!is_array($request->sheets)) {
            return response()->json([
                'success' => false
            ]);
        }

        // load user
        $user = Auth::user();
        $errors = [];

        foreach ($request->sheets as $item) {
            if (empty($item['id'])) {
                continue;
            }

            // load sheet
            $sheet = Sheet::find($item['id']);

            if (empty($sheet)) {
                continue;
            }

            // change
            $sheet->title = $item['title'];
            $sheet->page = $item['page'] ?? 1;

            // save
            $sheet->save();

            foreach ($item["sheet_answers"] as $sheet_answer) {
                if (empty($sheet_answer['id'])) {
                    continue;
                }

                // load answer
                $answer = SheetAnswer::find($sheet_answer['id']);

                if (empty($answer)) {
                    continue;
                }

                $answer->sheet_id = $sheet_answer['sheet_id'];
                $answer->answer = $sheet_answer['answer'];
                $answer->save();
            }
        }

        if (count($errors)) {
            return response()->json([
                'success' => false,
                'errors' => $errors
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
