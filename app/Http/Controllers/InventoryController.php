<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    public function index()
{
    // Récupérer l'inventaire
    $responseInventory = Http::get('http://localhost:8080/toad/inventory/all');
    
    // Vérifier si la requête pour l'inventaire a réussi
    if ($responseInventory->successful()) {
        $inventory = $responseInventory->json();
    } else {
        $inventory = [];
    }

    // Récupérer les films
    $responseFilms = Http::get('http://localhost:8080/toad/film/all');
    if ($responseFilms->successful()) {
        $films = $responseFilms->json();
    } else {
        $films = [];
    }

    // Associer les titres des films à l'inventaire
    foreach ($inventory as &$item) {
        // Trouver le titre du film basé sur l'ID du film dans l'inventaire
        $film = collect($films)->firstWhere('filmId', $item['filmId']);
        
        // Vérifier si un film avec cet ID a été trouvé et si le titre existe
        if ($film && isset($film['title'])) {
            $item['title'] = $film['title']; // Associer le titre au film
            $item['releaseYear'] = $film['releaseYear']; // Ajouter l'année de sortie (si nécessaire)
        } else {
            $item['title'] = 'Titre non disponible'; // Gérer le cas où le titre est absent
            $item['releaseYear'] = 'Inconnu'; // Gérer le cas où l'année de sortie est absente
        }
    }

    // Passer l'inventaire avec les titres associés à la vue
    return view('inventory', compact('inventory'));
}
public function edit($id)
{
    // Call the API to get the film and its stock data
    $response = Http::get('http://localhost:8080/toad/inventory/getStockByStore', [
        'id' => $id
    ]);

    // Check if the request was successful
    if ($response->successful()) {
        $film = $response->json(); // Store the response data in $film
        
        // Debugging: Let's make sure $film contains what we expect
        dd($film); // This will display the data so we can inspect it

        return view('inventory', ['film' => $film]); // Pass the film data to the view
    } else {
        return redirect()->route('inventory.index')->withErrors('Film not found.');
    }
}





}
