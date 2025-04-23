<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Employee;

Route ::get ('/', function () {
    return view('index');
});

Route::post('add_employees', function (Request $request) {
    $first_name = $request->input('first_name');
    $last_name = $request->input('last_name');
    $matricule = $request->input('matricule');
    $company_id = $request->input('company_id');
    return view('add_employees', compact('first_name', 'last_name', 'matricule', 'company_id'));
});

Route::get('show_employees', function () {
    $employees = Employee::all(); 
    return view('show_employees', compact('employees'));
});