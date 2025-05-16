<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\JobListing;  //Utilise desrormais le modele JobListing pour recuperer les donnees de la BD
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Available Jobs';
        if ($request->has('employer') && $request->employer != '') {
            $query = JobListing::query();
            $query->whereHas('employer', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->employer . '%');
            });
            $availableJobs = $query->with('employer', 'tags')->latest()->get(); // Récupère les offres d'emploi disponibles avec les informations de l'employeur
        } else {
            $availableJobs = JobListing::with('employer', 'tags')->latest()->get(); // Récupère les offres d'emploi disponibles avec les informations de l'employeur
        }
        return view('jobs.index', compact('title', 'availableJobs'));
    }
// --------------------------------------------------------------------------------------------------------------------
    
    // La fonction qui retourne la vue pour créer un nouvel job
    public function create()
    {
        $employers = Employer::all(); // Récupère tous les employeurs
        return view('jobs.create', compact('employers')); // Passe les employeurs à la vue
    }
// --------------------------------------------------------------------------------------------------------------------
    
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
// --------------------------------------------------------------------------------------------------------------------
    
    // La fonction qui retourne la vue pour afficher un job
    public function show(JobListing $job)
    {
        $job->load (['employer', 'tags']); // Charge les relations de l'employeur et des tags
        return view('jobs.show', compact('job')); // Passe le job à la vue
    }

    
    // La fonction qui retourne la vue pour editer un job
    public function edit(JobListing $job)
    {
        $employers = Employer::all(); // Récupère tous les employeurs
        return view('jobs.edit', compact('job', 'employers')); // Passe le job et les employeurs à la vue
    }
// --------------------------------------------------------------------------------------------------------------------
    
    // La fonction qui traite les donnees du formulaire d'edition
    public function update(Request $request, JobListing $job)
    {
        // Etape 1 - Validation des données
        $validated = $request->validate(
            [
                'title' => 'required|string|min:5|max:255',
                'description' => 'required|string|min:10',
                'company' => 'required|string|max:255',
                'location' => 'required|string|max:255',
            ]
        );

        // Etape 2 - Mise à jour des données dans la base de données
        $job->update($validated);
        return redirect('/jobs')->with('success', 'Job offer updated successfully!'); // Redirige vers la liste des jobs avec un message de succès  
    }
// --------------------------------------------------------------------------------------------------------------------
    
    // La fonction qui supprime un job
    public function destroy(JobListing $job)
    {
        $job->delete(); // Supprime le job
        return redirect('/jobs')->with('success', 'Job offer deleted successfully!'); // Redirige vers la liste des jobs avec un message de succès
    }
}