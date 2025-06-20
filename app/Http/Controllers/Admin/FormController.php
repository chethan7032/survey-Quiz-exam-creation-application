<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    public function create()
    {
        return view('admin.form-builder');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'schema' => 'required|json',
        ]);

        Form::create([
            'title' => $request->title,
            'description' => $request->description,
            'schema' => json_decode($request->schema, true),
            'status' => 'unpublished', // default
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.form-builder')->with('success', 'Form saved successfully!');
    }
}

