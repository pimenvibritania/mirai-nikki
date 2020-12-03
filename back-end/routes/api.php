<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Notes')->group(function(){
    Route::prefix('notes')->group(function(){
        Route::get('', 'NoteController@index');
        Route::post('new-note', 'NoteController@store');
        Route::get('{subject:slug}/{note:slug}', 'NoteController@show')->name('notes.show');
        Route::patch('{subject:slug}/{note:slug}/edit', 'NoteController@update');
        Route::delete('{subject:slug}/{note:slug}/delete', 'NoteController@destroy');

    });

    Route::prefix('subjects')->group(function(){
        Route::post('new-subject', 'SubjectController@store');
        Route::get('', 'SubjectController@index');
    });
});