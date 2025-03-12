<?php

use Illuminate\Http\Request;
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

// Query parameters
Route::get('/search', function (Request $request) {
    $keyword = $request->query('keyword');
    return "Le contenue keyword = " . $keyword;
});


Route::get('/myprofile', function () {
    return view('myprofile');
});

// Route::post('/result', function (Request $request) {
//     $name = $request->query('name');
//     $email = $request->query('email');
//     $age = $request->query('age');
//     return view('result', [
//         "name" => $name,
//         "email" => $email,
//         "age" => $age
//     ]);
// });

Route::post('/result', function (Request $request) {
    $name = $request->input('name');
    $email = $request->input('email');
    $age = $request->input('age');
    return view('result', compact('name', 'email', 'age'));
});