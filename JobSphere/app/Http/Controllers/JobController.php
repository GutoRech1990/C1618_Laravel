<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\JobListing;  //Utilise desrormais le modele JobListing pour recuperer les donnees de la BD
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $title = 'Available Jobs';
        $availableJobs = JobListing::with('employer')->latest()->get(); // Récupère les offres d'emploi disponibles avec les informations de l'employeur
        return view('jobs.index', compact('title', 'availableJobs'));
    }

    // La fonction qui retourne la vue pour créer un nouvel job
    public function create()
    {
        $employers = Employer::all(); // Récupère tous les employeurs
        return view('jobs.create', compact('employers')); // Passe les employeurs à la vue
    }

    // La fonction qui traite les donnees du formulaire
    public function store(Request $request)
    {
        // Etape 1 - Validation des données
        $validated = $request->validate(
            [
                'title' => 'required|string|min:5|max:255',
                'description' => 'required|string|min:10',
                'company' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'employer_id' => 'required|exists:employers,id', // Vérifie que l'employeur existe
            ]
        );

        // Etape 2 - Insertion des données dans la base de données
        JobListing::create($validated);
        return redirect('/jobs')->with('success', 'Job offer created successfully!'); // Redirige vers la liste des jobs avec un message de succès
    }
}