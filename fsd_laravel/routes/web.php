<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/employees', function () {
    return "All the employees";
});

Route::get('/testroute', function () {
    return "<a href='/employees'> All the employees </a>";
});


// Route avec des URL parameters

Route::get('/product/{id_product}', function (string $id_product) {
    return "Vous êtes sur la page produit: " . $id_product;
});

Route::get('/page/{pageNumber}/product/{id_product}', function (string $pageNumber, string $id_product) {
    return "Vous êtes sur la page: " . $pageNumber . " produit: " . $id_product;
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/jobs', function () {
    return view('jobs.index');
});

// Passing data to views
Route::get('/dashboard', function () {
    $welcomeMessage = "Welcome José";
    $news = ["Actualite 1", "Actualite 2", "Actualite 3"];
    return view(
        'dashboard',
        [
            "welcome" => $welcomeMessage,
            "news" => $news
        ]
    );
});
