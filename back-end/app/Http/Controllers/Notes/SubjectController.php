<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //
    public function index()
    {
        # code...

        return Subject::get();
    }

    public function store()
    {
        # code...
        request()->validate([
            'name' => 'required'
        ]);

        $subject = Subject::create([
            'name' => request('name'),
            'slug' => \Str::slug(request('name'))
        ]);

        return response()->json([
            'message' => 'Subject was created',
            'data' => $subject
        ], 200);
    }
}
