<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VaccinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all vaccines from the database
        $vaccins = \App\Models\Vaccin::orderBy('name')->get();

        // Return the view with the list of vaccines
        return view('vaccins.index', compact('vaccins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view with the form to create a new vaccine
        return view('vaccins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'fabricant' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        // Create a new vaccine instance
        $vaccin = new \App\Models\Vaccin();
        $vaccin->name = $request->input('name');
        $vaccin->fabricant = $request->input('fabricant');
        $vaccin->price = $request->input('price');

        // Save the vaccine to the database
        $vaccin->save();

        // Redirect to the vaccines index page with a success message
        return redirect()->route('vaccins.index')->with('success', 'Vaccine created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the vaccine by ID
        $vaccin = \App\Models\Vaccin::findOrFail($id);

        // Return the view with the vaccine details
        return view('vaccins.show', compact('vaccin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Fetch the vaccine by ID
        $vaccin = \App\Models\Vaccin::findOrFail($id);

        // Return the view with the form to edit the vaccine
        return view('vaccins.edit', compact('vaccin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'fabricant' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        // Fetch the vaccine by ID
        $vaccin = \App\Models\Vaccin::findOrFail($id);

        // Update the vaccine details
        $vaccin->name = $request->input('name');
        $vaccin->fabricant = $request->input('fabricant');
        $vaccin->price = $request->input('price');

        // Save the changes to the database
        $vaccin->save();

        // Redirect to the vaccines index page with a success message
        return redirect()->route('vaccins.index')->with('success', 'Vaccine updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Fetch the vaccine by ID
        $vaccin = \App\Models\Vaccin::findOrFail($id);

        // Delete the vaccine from the database
        $vaccin->delete();

        // Redirect to the vaccines index page with a success message
        return redirect()->route('vaccins.index')->with('success', 'Vaccine deleted successfully.');
    }
}
