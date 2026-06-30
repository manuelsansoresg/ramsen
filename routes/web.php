<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home', [
        'whatsapp' => '529993292148',
        'phoneLabel' => '9993 29 21 48',
    ]);
});
