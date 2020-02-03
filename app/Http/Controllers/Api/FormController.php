<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Sheet;

class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @return object
     */
    public function index(): object
    {
        $forms = Form::join('users', 'forms.user_id', '=', 'users.id')
            ->leftJoin('sheets', 'forms.id', '=', 'sheets.form_id')
            ->groupBy('formName', 'formId', 'formCreated', 'username')
            ->select(
                'forms.id AS formId',
                'forms.name AS formName',
                'forms.created_at AS formCreated',
                'users.name AS username',
                'users.id AS userId',
                DB::raw('COUNT(sheets.id) AS countSheets')
            )
            ->get();

        return response()->json($forms);
    }

    /**
     * @param Request $request
     * @return object
     */
    public function create(Request $request): object
    {
        $user = Auth::user();

        $form = new Form();

        $form->user_id = $user->id;
        $form->name = $request->name;

        $form->save();

        return response()->json([
            'formId' => $form->id,
            'formName' => $form->name,
            'formCreated' => $form->created_at,
            'countSheets' => 0,

            'username' => $user->name,
            'userId' => $user->id
        ]);
    }

    /**
     * @param int $form_id
     */

     public function show(int $form_id)
     {
        // load user
        $user = Auth::user();

        // load form
        $form = Form::select('forms.id', 'forms.user_id', 'forms.name', 'forms.created_at')
            ->findOrFail($form_id);

        if (!$user->can('show', $form)) {
            return abort(403);
        }

        $form_sheets = Sheet::where('sheets.form_id', $form_id)
            ->with(['sheetAnswers:id,sheet_id,answer,created_at'])
            ->get();

        return response()->json([
            'form' => $form,
            'formSheets' => $form_sheets
        ]);
     }
    
    /**
     * @param int $form_id
     */
    public function destroy(int $form_id): object
    {
        $result = Form::whereId($form_id)->delete();

        return response()->json([
            'formId' => $form_id
        ]);
    }
}
