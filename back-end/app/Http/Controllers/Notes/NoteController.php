<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;
use App\Models\{Note, Subject};

class NoteController extends Controller
{
    //
    public function index()
    {
        # code...
        $notes = Note::with('subject')->latest()->get();
        return NoteResource::collection($notes);
    }

    public function show(Subject $subject, Note $note)
    {
        # code...
        return NoteResource::make($note);

    }

    public function store()
    {
        # code...

        request()->validate([
            'title' => 'required',
            'subject' => 'required',
            'description' => 'required'
        ]);

        $subject = Subject::findOrFail(request('subject'));

        $note = Note::create([
            'subject_id' => $subject->id,
            'title' => request('title'),
            'description' => request('description'),
            'slug' => \Str::slug(request('title'))

        ]);

        return response()->json([
            'message' => 'your notes created',
            'note' => $note
        ]);
    }

    public function update(Subject $subject, Note $note)
    {
        # code...
        request()->validate([
            'title' => 'required',
            'subject' => 'required',
            'description' => 'required'
        ]);

        $subject = Subject::findOrFail(request('subject'));

        $note->update([
            'subject_id' => $subject->id,
            'title' => request('title'),
            'description' => request('description'),
            'slug' => \Str::slug(request('title'))

        ]);

        return response()->json([
            'message' => 'your notes created',
            'note' => $note
        ]);
    }
 
    public function destroy(Subject $subject, Note $note)
    {
        # code...
        $note->delete();

        return response()->json([
            'message' => 'your notes deleted',
            'note' => $note
        ], 200);
    }
}
