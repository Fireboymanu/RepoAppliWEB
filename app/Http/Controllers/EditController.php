<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EditController extends Controller
{
    /**
     * Display the edit form for a specific film.
     */
    public function edit($id)
    {
        // Fetch the film data from the API
        $url = "http://localhost:8080/toad/film/getById?id={$id}";
        $response = Http::get($url);

        if ($response->ok()) {
            $film = $response->json();
            return view('edit', compact('film')); // Pass the film data to the edit view
        }

        return redirect()->route('Edit.index')->withErrors('Film non trouvé.');
    }

    /**
     * Update the specified film in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'length' => 'required|integer',
            'rating' => 'nullable|numeric',
            'rentalDuration' => 'required|integer',
            'releaseYear' => 'required|integer',
        ]);

        // Prepare the data to send in the API request
        $data = $request->only([
            'title', 'description', 'length', 'rating', 'rentalDuration', 'releaseYear'
        ]);

        // Send PUT request to update the film via the API
        $url = "http://localhost:8080/toad/film/update?id={$id}";
        $response = Http::put($url, $data);

        if ($response->ok()) {
            return redirect()->route('Edit.index')->with('success', 'Film modifié avec succès!');
        }

        return back()->withErrors('Erreur lors de la mise à jour du film.');
    }
}
