<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Vaccination;
use App\Models\Vaccin;

class PatientController extends Controller
{
    /**
     * La function index qui affiche la liste des patients.
     */
    public function index()
    {
        // Récupérer tous les patients em ordre alphabétique
        $patients = \App\Models\Patient::orderBy('name', 'asc')->get();
        // $patients = \App\Models\Patient::all();

        // Retourner la vue avec les patients
        return view('patients.index', compact('patients'));
    }
    // -------------------------------------------------------------------------------------

    /**
     * La fonction create qui affiche le formulaire de création d'un patient.
     */
    public function create()
    {
        // Récupérer tous les vaccins
        $vaccins = Vaccin::all();

        // Retourner la vue avec le formulaire de création
        return view('patients.create', compact('vaccins'));
    }
    // -------------------------------------------------------------------------------------

    /**
     * La fonction store qui enregistre un nouveau patient dans la base de données.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'adress' => 'required|string|max:255',
            'birth_date' => 'required|date',
        ]);

        // Créer un nouveau patient
        $patient = new Patient();
        $patient->name = $request->input('name');
        $patient->age = $request->input('age');
        $patient->adress = $request->input('adress');
        $patient->birth_date = $request->input('birth_date');
        // Enregistrer le patient dans la base de données
        $patient->save();

        // Rediriger vers la liste des patients avec un message de succès
        return redirect()->route('patients.index')->with('success', 'Patient créé avec succès.');
    }
    // -------------------------------------------------------------------------------------

    /**
     * La fonction show qui affiche les détails d'un patient spécifique.
     */
    public function show(string $id)
    {
        // Récupérer le patient par son ID
        $patient = Patient::findOrFail($id);

        // Récupérer les vaccinations du patient
        $vaccinations = Vaccination::where('patient_id', $id)->get();

        // Retourner la vue avec les détails du patient
        return view('patients.show', compact('patient', 'vaccinations'));
    }
    // -------------------------------------------------------------------------------------

    /**
     * La fonction edit qui affiche le formulaire d'édition d'un patient.
     */
    public function edit(string $id)
    {
        // Récupérer le patient par son ID
        $patient = Patient::findOrFail($id);

        // Récupérer tous les vaccins
        $vaccins = Vaccin::all();

        // Retourner la vue avec le formulaire d'édition
        return view('patients.edit', compact('patient', 'vaccins'));
    }
    // -------------------------------------------------------------------------------------

    /**
     * La fonction update qui met à jour les informations d'un patient.
     */
    public function update(Request $request, string $id)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'adress' => 'required|string|max:255',
            'birth_date' => 'required|date',
        ]);

        // Récupérer le patient par son ID
        $patient = Patient::findOrFail($id);

        // Mettre à jour les informations du patient
        $patient->name = $request->input('name');
        $patient->age = $request->input('age');
        $patient->adress = $request->input('adress');
        $patient->birth_date = $request->input('birth_date');
        // Enregistrer les modifications dans la base de données
        $patient->save();

        // Rediriger vers la liste des patients avec un message de succès
        return redirect()->route('patients.index')->with('success', 'Patient mis à jour avec succès.');
    }
    // -------------------------------------------------------------------------------------

    /**
     * La fonction destroy qui supprime un patient de la base de données.
     */
    public function destroy(string $id)
    {
        // Récupérer le patient par son ID
        $patient = Patient::findOrFail($id);

        // Supprimer le patient de la base de données
        $patient->delete();

        // Rediriger vers la liste des patients avec un message de succès
        return redirect()->route('patients.index')->with('success', 'Patient supprimé avec succès.');
    }

    /**
     * La fonction hasVaccinations qui vérifie si un patient a des vaccinations.
     */
    public function hasVaccinations($id)
    {
        $hasVaccinations = \App\Models\Vaccination::where('patient_id', $id)->exists();

        return response()->json(['hasVaccinations' => $hasVaccinations]);
    }
}
