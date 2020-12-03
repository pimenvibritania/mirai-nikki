<?php

use Illuminate\Support\Facades\Route;

// Route::get('/{any?}', function () {
//     return view('app');
// });

Route::view('/{any?}', 'app')->where('any', '.*');