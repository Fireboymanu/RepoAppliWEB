<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Inventory;


class InventoryController extends Controller
{
    /**
     * Afficher la liste de l'inventaire avec les films associés.
     */
    public function index()
    {
        // Récupérer l'inventaire depuis l'API
        //$responseInventory = Http::get('http://localhost:8080/toad/inventory/getStockByStore');
        $adress = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $responseInventory = Http::get($adress.$port."/toad/inventory/getStockByStore");

        if (!$responseInventory->successful()) {
            return redirect()->route('dashboard')->withErrors('Erreur lors de la récupération de l\'inventaire.');
        }

        $inventory = json_decode(trim($responseInventory->body()), true);

        if ($inventory === null) {
            dd('Erreur JSON Inventory:', json_last_error_msg(), $responseInventory->body());
        }

        // Vérification si l'inventaire est vide
        if (empty($inventory)) {
            return view('inventory.index')->with('message', 'Aucun élément dans l\'inventaire.');
        }

        // Récupérer les films
        //$responseFilms = Http::get('http://localhost:8080/toad/inventory/getStockByStore');
        $adress = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $responseFilms = Http::get($adress.$port."/toad/inventory/getStockByStore");
        if (!$responseFilms->successful()) {
            return redirect()->route('dashboard')->withErrors('Erreur lors de la récupération des films.');
        }

        $films = json_decode(trim($responseFilms->body()), true);

        if ($films === null) {
            dd('Erreur JSON Films:', json_last_error_msg(), $responseFilms->body());
        }
        

        // Associer les titres des films à l'inventaire
        foreach ($inventory as &$item) {
            $film = collect($films)->firstWhere('filmId', $item['filmId']);

            // Ajouter les informations du film à l'inventaire
            $item['title'] = $film['title'] ?? 'Titre non disponible';
            $item['quantity'] = $film['quantity'] ?? 'Quantité non disponible';
        }

        
        return view('films.index', ['films' => $inventory]);


    }

    /**
     * Afficher le formulaire d'édition du stock d'un film.
     */
    public function edit($id)
{
    // Appel à l'API avec l'ID dans la query string
    //$response = Http::get("http://localhost:8080/toad/inventory/getStockByStore");
    $adress = env('TOAD_SERVER');
    $port = env('TOAD_PORT');
    $response = Http::get($adress.$port."/toad/inventory/getStockByStore");


    


    if (!$response->successful()) {
        return redirect()->route('inventory.index')->withErrors('Échec de la récupération des données du stock.');
    }

    $films = json_decode(trim($response->body()), true);


    if ($films === null) {
        dd('Erreur JSON Stock:', json_last_error_msg(), $response->body());
    }

    // Trouver le film correspondant
    $film = collect($films)->firstWhere('filmId', $id);

    if (!$film) {
        return redirect()->route('inventory.index')->withErrors('Film non trouvé.');
    }

    return view('inventory.edit', compact('film'))->with('debug', $film);

}

public function update(Request $request, $id)
{
    // Récupérer l'élément à mettre à jour
    $inventory = Inventory::findOrFail($id);

    // Valider les données du formulaire
    $request->validate([
        'name' => 'required|string|max:255',
        'quantity' => 'required|integer|min:0',
    ]);

    // Mettre à jour l'élément
    $inventory->update([
        'name' => $request->input('name'),
        'quantity' => $request->input('quantity'),
    ]);

    // Rediriger avec un message de succès
    return redirect()->route('inventory.index')->with('success', 'Inventaire mis à jour avec succès.');
}


}
