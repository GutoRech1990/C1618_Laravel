<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VaccinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = \App\Models\Patient::all();
        $vaccinations = \App\Models\Vaccination::all();

        return view('patients.index', compact('patients', 'vaccinations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($patientId)
    {
        // Cherche le patient par ID
        $patient = \App\Models\Patient::findOrFail($patientId);
        // Fetch all patients and vaccines from the database
        $vaccins = \App\Models\Vaccin::orderBy('name')->get();

        // Return the view with the form to create a new vaccination
        return view('vaccinations.create', compact('patient', 'vaccins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'vaccin_id' => 'required|exists:vaccins,id',
            'vaccination_date' => 'required|date',
        ]);

        // Check if the patient already has a vaccination for the same vaccine
        $existingVaccination = \App\Models\Vaccination::where('patient_id', $request->input('patient_id'))
            ->where('vaccin_id', $request->input('vaccin_id'))
            ->first();
        if ($existingVaccination) {
            return redirect()->back()->withErrors(['vaccin_id' => 'Ce patient a déjà été vacciné pour ce vaccin.']);
        }


        // Create a new vaccination instance
        $vaccination = new \App\Models\Vaccination();
        $vaccination->patient_id = $request->input('patient_id');
        $vaccination->vaccin_id = $request->input('vaccin_id');
        $vaccination->vaccination_date = $request->input('vaccination_date');

        // Save the vaccination to the database
        $vaccination->save();

        // Redirect to the vaccinations index page with a success message
        return redirect()->route('vaccinations.show', $request->input('patient_id'))->with('success', 'Vaccination réalisée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $patientId)
    {
        // Fetch le patient by ID
        $patient = \App\Models\Patient::findOrFail($patientId);

        // Cherche les vaccin associés au patient
        $vaccinations = \App\Models\Vaccination::where('patient_id', $patientId)->with('vaccin')->get();

        // Retourne la vue avec les détails de la vaccination
        return view('vaccinations.show', compact('patient', 'vaccinations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Fetch the vaccination by ID
        $vaccination = \App\Models\Vaccination::findOrFail($id);

        // Fetch all patients and vaccines from the database
        $patients = \App\Models\Patient::orderBy('name')->get();
        $vaccins = \App\Models\Vaccin::orderBy('name')->get();

        // Return the view with the form to edit the vaccination
        return view('vaccinations.edit', compact('vaccination', 'patients', 'vaccins'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'vaccin_id' => 'required|exists:vaccins,id',
            'vaccination_date' => 'required|date',
        ]);

        // Fetch the vaccination by ID
        $vaccination = \App\Models\Vaccination::findOrFail($id);

        // Update the vaccination details
        $vaccination->patient_id = $request->input('patient_id');
        $vaccination->vaccin_id = $request->input('vaccin_id');
        $vaccination->vaccination_date = $request->input('vaccination_date');

        // Save the updated vaccination to the database
        $vaccination->save();

        // Redirect to the patient's show page with a success message
        return redirect()->route('vaccinations.show', $vaccination->patient_id)->with('success', 'La vaccination a été mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Fetch the vaccination by ID
        $vaccination = \App\Models\Vaccination::findOrFail($id);

        // Get the patient ID from the vaccination record
        $patientId = $vaccination->patient_id;

        // Delete the vaccination from the database
        $vaccination->delete();

        // Redirect to the vaccinations index page with a success message
        return redirect()->route('vaccinations.show', $patientId)->with('success', 'Vaccination supprimée avec succès.');
    }
}
