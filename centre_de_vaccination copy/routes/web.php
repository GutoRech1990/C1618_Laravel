<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VaccinController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\VaccinationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');
Route::get('/patients/{id}/has-vaccinations', [PatientController::class, 'hasVaccinations'])->name('patients.hasVaccinations');

Route::get('/vaccins', [VaccinController::class, 'index'])->name('vaccins.index');
Route::get('/vaccins/create', [VaccinController::class, 'create'])->name('vaccins.create');
Route::post('/vaccins', [VaccinController::class, 'store'])->name('vaccins.store');
Route::get('/vaccins/{vaccin}/edit', [VaccinController::class, 'edit'])->name('vaccins.edit');
Route::put('/vaccins/{vaccin}', [VaccinController::class, 'update'])->name('vaccins.update');
Route::delete('/vaccins/{vaccin}', [VaccinController::class, 'destroy'])->name('vaccins.destroy');
Route::get('/vaccins/{id}/patients', [VaccinController::class, 'getAssociatedPatients'])->name('vaccins.patients');

Route::get('/vaccinations', [VaccinationController::class, 'index'])->name('vaccinations.index');
Route::get('/vaccinations/{patient}/create', [VaccinationController::class, 'create'])->name('vaccinations.create');
Route::post('/vaccinations', [VaccinationController::class, 'store'])->name('vaccinations.store');
Route::get('/vaccinations/{vaccination}/edit', [VaccinationController::class, 'edit'])->name('vaccinations.edit');
Route::put('/vaccinations/{vaccination}', [VaccinationController::class, 'update'])->name('vaccinations.update');
Route::delete('/vaccinations/{vaccination}', [VaccinationController::class, 'destroy'])->name('vaccinations.destroy');
Route::get('/vaccinations/{vaccination}', [VaccinationController::class, 'show'])->name('vaccinations.show');
