<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
 
 


class EditController extends Controller
{
    /**
     * Display the edit form for a specific film.
     */
    public function edit($id)
    {

        $adress = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        // Fetch the film data from the API
        $apiUrl = $adress.$port."/toad/film/getById?id={$id}"; 
        $response = Http::get($apiUrl);
        

        if ($response->ok()) {
            $film = $response->json();
            return view('edit', compact('film')); // Pass the film data to the edit view
        }

        return redirect()->route('Edit.index', ['id' => $id])->withErrors('Film non trouvé.');
    }

    /**
     * Update the specified film in storage.
     */
    public function update(Request $request, $id)
{
    // Validation des champs requis
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'length' => 'required|integer|min:1',
        'rating' => 'nullable|string|in:R,G,PG,PG-13,NC-17',
        'rentalDuration' => 'required|integer|min:1', 
        'releaseYear' => 'required|integer|min:1900|max:' . date('Y'),

    ]);

    // Préparer les données pour l'API
    $data = [
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'length' => $validatedData['length'],
        'rating' => $validatedData['rating'],
        'rentalDuration' => $validatedData['rentalDuration'],
        'releaseYear' => $validatedData['releaseYear']
    ];


    // Récupérer les données envoyées depuis le formulaire
    $data = $request->all();
    $adress = env('TOAD_SERVER');
    $port = env('TOAD_PORT');
    $endpointUpdateFilm ='/toad/film/update/';
    $servRequest = $adress . $port . $endpointUpdateFilm.$id;
    $lastUpdate = Carbon::now()->format('Y-m-d H:i:s'); // Format attendu : 'YYYY-MM-DD HH:MM:SS'
    $data['lastUpdate'] = $lastUpdate;
    $response = Http::asForm()->put($servRequest, $data);

    Log::info($response->body());

    // Vérifier la réponse de l'API
    if ($response->successful()) {
        Log::info('Réponse de l\'API réussie');
        return redirect()->route('Edit.index', ['id' => $id])->with('success', 'Film modifié avec succès !');

    }

    return back()->withErrors('Erreur lors de la mise à jour du film.');
}

}
