<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Vaccination;
use App\Models\Vaccin;

class PatientController extends Controller
{
    /**
     * La fonction index qui affiche la liste des patients.
     * Cette méthode récupère tous les patients et les trie par ordre alphabétique.
     */
    public function index()
    {
        // Récupérer tous les patients en ordre alphabétique par nom
        $patients = \App\Models\Patient::orderBy('name', 'asc')->get();

        // Retourner la vue avec les patients triés
        return view('patients.index', compact('patients'));
    }
    // -------------------------------------------------------------------------------------

    /**
     * La fonction create qui affiche le formulaire de création d'un patient.
     * Cette méthode charge également la liste des vaccins disponibles pour référence.
     */
    public function create()
    {
        // Récupérer tous les vaccins pour le formulaire
        $vaccins = Vaccin::all();

        // Retourner la vue avec le formulaire de création et la liste des vaccins
        return view('patients.create', compact('vaccins'));
    }
    // -------------------------------------------------------------------------------------

    /**
     * La fonction store qui enregistre un nouveau patient dans la base de données.
     * Cette méthode valide les données entrées et crée un nouveau patient.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire avec les règles requises
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'adress' => 'required|string|max:255',
            'birth_date' => 'required|date',
        ]);

        // Créer un nouveau patient avec les données validées
        $patient = new Patient();
        $patient->name = $request->input('name');
        $patient->age = $request->input('age');
        $patient->adress = $request->input('adress');
        $patient->birth_date = $request->input('birth_date');

        // Enregistrer le patient dans la base de données
        $patient->save();

        // Rediriger vers la liste des patients avec un message de confirmation
        return redirect()->route('patients.index')->with('success', 'Patient créé avec succès.');
    }
    // -------------------------------------------------------------------------------------

    /**
     * La fonction show qui affiche les détails d'un patient spécifique.
     * Cette méthode récupère également l'historique des vaccinations du patient.
     */
    public function show(string $id)
    {
        // Récupérer le patient par son ID avec vérification d'existence
        $patient = Patient::findOrFail($id);

        // Récupérer l'historique complet des vaccinations du patient
        $vaccinations = Vaccination::where('patient_id', $id)->get();

        // Retourner la vue avec les informations du patient et son historique
        return view('patients.show', compact('patient', 'vaccinations'));
    }
    // -------------------------------------------------------------------------------------

    /**
     * La fonction edit qui affiche le formulaire d'édition d'un patient.
     * Cette méthode charge les données du patient et la liste des vaccins disponibles.
     */
    public function edit(string $id)
    {
        // Récupérer le patient par son ID avec vérification d'existence
        $patient = Patient::findOrFail($id);

        // Récupérer la liste des vaccins pour le formulaire
        $vaccins = Vaccin::all();

        // Retourner la vue avec le formulaire pré-rempli
        return view('patients.edit', compact('patient', 'vaccins'));
    }
    // -------------------------------------------------------------------------------------

    /**
     * La fonction update qui met à jour les informations d'un patient.
     * Cette méthode valide les nouvelles données et met à jour le patient existant.
     */
    public function update(Request $request, string $id)
    {
        // Valider les données du formulaire avec les règles requises
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'adress' => 'required|string|max:255',
            'birth_date' => 'required|date',
        ]);

        // Récupérer le patient existant par son ID
        $patient = Patient::findOrFail($id);

        // Mettre à jour les informations du patient
        $patient->name = $request->input('name');
        $patient->age = $request->input('age');
        $patient->adress = $request->input('adress');
        $patient->birth_date = $request->input('birth_date');

        // Sauvegarder les modifications dans la base de données
        $patient->save();

        // Rediriger vers la liste des patients avec un message de confirmation
        return redirect()->route('patients.index')->with('success', 'Patient mis à jour avec succès.');
    }
    // -------------------------------------------------------------------------------------

    /**
     * La fonction destroy qui supprime un patient de la base de données.
     * Cette méthode vérifie d'abord l'existence du patient avant de le supprimer.
     */
    public function destroy(string $id)
    {
        // Récupérer le patient par son ID avec vérification d'existence
        $patient = Patient::findOrFail($id);

        // Supprimer le patient et toutes ses vaccinations associées (via cascade)
        $patient->delete();

        // Rediriger vers la liste des patients avec un message de confirmation
        return redirect()->route('patients.index')->with('success', 'Patient supprimé avec succès.');
    }

    /**
     * La fonction hasVaccinations qui vérifie si un patient a des vaccinations.
     * Cette méthode est utilisée pour les vérifications AJAX avant la suppression d'un patient.
     */
    public function hasVaccinations($id)
    {
        // Vérifier l'existence de vaccinations pour ce patient
        $hasVaccinations = \App\Models\Vaccination::where('patient_id', $id)->exists();

        // Retourner le résultat en format JSON pour la requête AJAX
        return response()->json(['hasVaccinations' => $hasVaccinations]);
    }
}
