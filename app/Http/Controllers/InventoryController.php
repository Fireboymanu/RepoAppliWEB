<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class InventoryController extends Controller
{
    public function index()
    {
        $adress = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $url = $adress . $port . "/toad/inventory/getStockByStore";

        $responseInventory = Http::get($url);
        if (!$responseInventory->successful()) {
            return redirect()->route('dashboard')->withErrors('Erreur lors de la récupération de l\'inventaire.');
        }

        $inventory = json_decode(trim($responseInventory->body()), true);
        if (!$inventory) {
            return view('inventory.index')->with('message', 'Aucun élément dans l\'inventaire.');
        }

        $responseFilms = Http::get($url);
        if (!$responseFilms->successful()) {
            return redirect()->route('dashboard')->withErrors('Erreur lors de la récupération des films.');
        }

        $films = json_decode(trim($responseFilms->body()), true);
        foreach ($inventory as &$item) {
            $film = collect($films)->firstWhere('filmId', $item['filmId']);
            $item['title'] = $film['title'] ?? 'Titre non disponible';
            $item['quantity'] = $film['quantity'] ?? 'Quantité non disponible';
        }

        return view('films.index', ['films' => $inventory]);
    }

    public function create()
    {
        $adress = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $response = Http::get($adress . $port . "/toad/film/all");

        if (!$response->successful()) {
            return redirect()->route('inventory.index')->withErrors('Erreur lors de la récupération des films.');
        }

        $films = json_decode(trim($response->body()), true);
        return view('inventory.create', compact('films'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'film_id' => 'required',
        ]);

        $adress = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $url = $adress . $port . '/toad/inventory/add';

        $data = [
            'film_id' => $request->input('film_id'),
            'lastUpdate' => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        $response = Http::asForm()->post($url, $data);

        if ($response->successful()) {
            return redirect()->route('inventory.create')->with('success', 'DVD ajouté avec succès !');
        }

        return back()->withErrors(['message' => 'Erreur lors de l\'ajout du film.'])->withInput();
    }
}
