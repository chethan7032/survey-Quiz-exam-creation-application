<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    /**
     * Show the Form Builder page
     */
    public function create()
    {
        return view('admin.form-builder');
    }

    /**
     * Store a new form into the database
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'schema'      => 'required|json',
        ]);

        Form::create([
            'title'       => $request->title,
            'description' => $request->description,
            'schema'      => json_decode($request->schema, true),
            'status'      => 'unpublished', // Default status
            'created_by'  => Auth::id(),
        ]);

        return redirect()->route('admin.form-builder')->with('success', '✅ Form saved successfully!');
    }

    /**
     * Show all forms (for admin dashboard)
     */
    public function index()
    {
        $forms = Form::latest()->get();
        return view('admin.forms.index', compact('forms'));
    }

    /**
     * Show a read-only preview of a form
     */
    public function preview(Form $form)
    {
        return view('admin.forms.preview', compact('form'));
    }

    /**
     * Toggle form's published status
     */
    public function toggle(Form $form)
    {
        $form->status = $form->status === 'published' ? 'unpublished' : 'published';
        $form->save();

        return back()->with('success', 'Form status updated.');
    }

    /**
     * Delete a form
     */
    public function destroy(Form $form)
    {
        $form->delete();
        return back()->with('success', 'Form deleted successfully.');
    }
}
