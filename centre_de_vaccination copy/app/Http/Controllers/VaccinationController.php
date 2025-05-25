<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VaccinationController extends Controller
{
    /**
     * Affiche la liste de toutes les vaccinations.
     * Cette méthode récupère tous les patients et leurs vaccinations associées.
     */
    public function index()
    {
        // Récupère tous les patients
        $patients = \App\Models\Patient::all();
        // Récupère toutes les vaccinations
        $vaccinations = \App\Models\Vaccination::all();

        // Retourne la vue avec les patients et leurs vaccinations
        return view('patients.index', compact('patients', 'vaccinations'));
    }

    /**
     * Affiche le formulaire pour créer une nouvelle vaccination.
     * @param int $patientId L'identifiant du patient à vacciner
     */
    public function create($patientId)
    {
        // Récupère le patient par son ID
        $patient = \App\Models\Patient::findOrFail($patientId);
        // Récupère tous les vaccins disponibles, triés par nom
        $vaccins = \App\Models\Vaccin::orderBy('name')->get();

        // Retourne la vue avec le formulaire de création d'une vaccination
        return view('vaccinations.create', compact('patient', 'vaccins'));
    }

    /**
     * Enregistre une nouvelle vaccination dans la base de données.
     * Vérifie également si le patient n'a pas déjà reçu ce vaccin.
     */
    public function store(Request $request)
    {
        // Valide les données du formulaire
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'vaccin_id' => 'required|exists:vaccins,id',
            'vaccination_date' => 'required|date',
        ]);

        // Vérifie si le patient a déjà reçu ce vaccin
        $existingVaccination = \App\Models\Vaccination::where('patient_id', $request->input('patient_id'))
            ->where('vaccin_id', $request->input('vaccin_id'))
            ->first();
        if ($existingVaccination) {
            return redirect()->back()->withErrors(['vaccin_id' => 'Ce patient a déjà été vacciné pour ce vaccin.']);
        }

        // Crée une nouvelle instance de vaccination
        $vaccination = new \App\Models\Vaccination();
        $vaccination->patient_id = $request->input('patient_id');
        $vaccination->vaccin_id = $request->input('vaccin_id');
        $vaccination->vaccination_date = $request->input('vaccination_date');

        // Sauvegarde la vaccination dans la base de données
        $vaccination->save();

        // Redirige vers la page de détails des vaccinations du patient avec un message de succès
        return redirect()->route('vaccinations.show', $request->input('patient_id'))->with('success', 'Vaccination réalisée avec succès.');
    }

    /**
     * Affiche les détails des vaccinations d'un patient spécifique.
     * @param string $patientId L'identifiant du patient
     */
    public function show(string $patientId)
    {
        // Récupère le patient par son ID
        $patient = \App\Models\Patient::findOrFail($patientId);

        // Récupère toutes les vaccinations du patient avec les informations des vaccins associés
        $vaccinations = \App\Models\Vaccination::where('patient_id', $patientId)->with('vaccin')->get();

        // Retourne la vue avec les détails du patient et ses vaccinations
        return view('vaccinations.show', compact('patient', 'vaccinations'));
    }

    /**
     * Affiche le formulaire pour modifier une vaccination existante.
     */
    public function edit(string $id)
    {
        // Récupère la vaccination par son ID
        $vaccination = \App\Models\Vaccination::findOrFail($id);

        // Récupère tous les patients et vaccins pour les listes déroulantes
        $patients = \App\Models\Patient::orderBy('name')->get();
        $vaccins = \App\Models\Vaccin::orderBy('name')->get();

        // Retourne la vue avec le formulaire de modification
        return view('vaccinations.edit', compact('vaccination', 'patients', 'vaccins'));
    }

    /**
     * Met à jour une vaccination existante dans la base de données.
     */
    public function update(Request $request, string $id)
    {
        // Valide les données du formulaire
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'vaccin_id' => 'required|exists:vaccins,id',
            'vaccination_date' => 'required|date',
        ]);

        // Récupère la vaccination par son ID
        $vaccination = \App\Models\Vaccination::findOrFail($id);

        // Met à jour les informations de la vaccination
        $vaccination->patient_id = $request->input('patient_id');
        $vaccination->vaccin_id = $request->input('vaccin_id');
        $vaccination->vaccination_date = $request->input('vaccination_date');

        // Sauvegarde les modifications dans la base de données
        $vaccination->save();

        // Redirige vers la page de détails des vaccinations du patient avec un message de succès
        return redirect()->route('vaccinations.show', $vaccination->patient_id)->with('success', 'La vaccination a été mise à jour avec succès.');
    }

    /**
     * Supprime une vaccination de la base de données.
     */
    public function destroy(string $id)
    {
        // Récupère la vaccination par son ID
        $vaccination = \App\Models\Vaccination::findOrFail($id);

        // Stocke l'ID du patient pour la redirection
        $patientId = $vaccination->patient_id;

        // Supprime la vaccination de la base de données
        $vaccination->delete();

        // Redirige vers la page de détails des vaccinations du patient avec un message de succès
        return redirect()->route('vaccinations.show', $patientId)->with('success', 'Vaccination supprimée avec succès.');
    }
}
