<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;

class FormViewController extends Controller
{
    // Show all published forms
    public function index()
    {
        $forms = Form::where('status', 'published')->latest()->get();
        return view('user.forms', compact('forms'));
    }

    // Show form for filling
    public function show(Form $form)
    {
        if ($form->status !== 'published') {
            abort(403, 'This form is not published.');
        }

        return view('user.fill-form', compact('form'));
    }

// public function submit(Request $request, Form $form)
// {
//     $request->validate([
//         'form_data' => 'required|array',
//     ]);

//     Submission::create([
//         'form_id' => $form->id,
//         'user_id' => Auth::id(),
//         'form_data' => $request->form_data,
//         'submitted_at' => now(),
//     ]);

//     return response()->json(['status' => 'success']);
// }



public function submit(Request $request, Form $form)
{
    // 💡 Capture all form fields from Form.io
    $data = $request->all();

    Submission::create([
        'form_id'     => $form->id,
        'user_id'     => Auth::id(),
        'form_data'   => $data, // Laravel will cast this to JSON
        'submitted_at' => now(),
    ]);

    return response()->json(['status' => 'success']);
}




}
