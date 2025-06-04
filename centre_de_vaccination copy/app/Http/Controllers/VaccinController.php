<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VaccinController extends Controller
{
    /**
     * Affiche la liste de tous les vaccins.
     */
    public function index()
    {
        // Récupère tous les vaccins de la base de données, triés par nom
        $vaccins = \App\Models\Vaccin::orderBy('name')->get();

        // Retourne la vue avec la liste des vaccins
        return view('vaccins.index', compact('vaccins'));
    }

    /**
     * Affiche le formulaire pour créer un nouveau vaccin.
     */
    public function create()
    {
        // Retourne la vue contenant le formulaire de création d'un nouveau vaccin
        return view('vaccins.create');
    }

    /**
     * Enregistre un nouveau vaccin dans la base de données.
     */
    public function store(Request $request)
    {
        // Valide les données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'fabricant' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        // Crée une nouvelle instance de vaccin
        $vaccin = new \App\Models\Vaccin();
        $vaccin->name = $request->input('name');
        $vaccin->fabricant = $request->input('fabricant');
        $vaccin->price = $request->input('price');

        // Sauvegarde le vaccin dans la base de données
        $vaccin->save();

        // Redirige vers la liste des vaccins avec un message de succès
        return redirect()->route('vaccins.index')->with('success', 'Vaccin créé avec succès.');
    }

    /**
     * Affiche les détails d'un vaccin spécifique.
     */
    public function show(string $id)
    {
        // Récupère le vaccin par son ID
        $vaccin = \App\Models\Vaccin::findOrFail($id);

        // Retourne la vue avec les détails du vaccin
        return view('vaccins.show', compact('vaccin'));
    }

    /**
     * Affiche le formulaire pour modifier un vaccin existant.
     */
    public function edit(string $id)
    {
        // Récupère le vaccin par son ID
        $vaccin = \App\Models\Vaccin::findOrFail($id);

        // Retourne la vue avec le formulaire de modification
        return view('vaccins.edit', compact('vaccin'));
    }

    /**
     * Met à jour un vaccin existant dans la base de données.
     */
    public function update(Request $request, string $id)
    {
        // Valide les données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'fabricant' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        // Récupère le vaccin par son ID
        $vaccin = \App\Models\Vaccin::findOrFail($id);

        // Met à jour les informations du vaccin
        $vaccin->name = $request->input('name');
        $vaccin->fabricant = $request->input('fabricant');
        $vaccin->price = $request->input('price');

        // Sauvegarde les modifications dans la base de données
        $vaccin->save();

        // Redirige vers la liste des vaccins avec un message de succès
        return redirect()->route('vaccins.index')->with('success', 'Vaccin mis à jour avec succès.');
    }

    /**
     * Supprime un vaccin de la base de données.
     */
    public function destroy(string $id)
    {
        // Récupère le vaccin par son ID
        $vaccin = \App\Models\Vaccin::findOrFail($id);

        // Supprime le vaccin de la base de données
        $vaccin->delete();

        // Redirige vers la liste des vaccins avec un message de succès
        return redirect()->route('vaccins.index')->with('success', 'Vaccin supprimé avec succès.');
    }
}
