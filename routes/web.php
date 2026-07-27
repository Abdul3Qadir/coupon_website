<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/stores', function () {
    return view('stores');
});

Route::get('/categories', function () {
    return view('categories');
});

Route::get('/deals', function () {
    return view('deals');
});

Route::get('/stores/brand', function () {
    return view('brand-details');
});
