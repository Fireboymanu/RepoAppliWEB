<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
 
 

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Requête pour obtenir tous les films depuis l'API
    //$response = Http::get('http://localhost:8080/toad/film/all');
    $adress = env('TOAD_SERVER');
    $port = env('TOAD_PORT');
    $response = Http::get($adress.$port."/toad/film/all");
    
    // Vérifier si la requête a réussi
    if ($response->successful()) {
        $films = $response->json(); // Récupérer tous les films de l'API
    } else {
        // Si l'API échoue, on renvoie un tableau vide
        $films = [];
    }

    return view('catalogue', compact('films')); // Passer les films à la vue
}


public function search(Request $request)
{
    $query = $request->input('query');

    if ($query) {
        // Effectuer la recherche par le terme de recherche
        //$response = Http::get("http://localhost:8080/toad/film/search", 
        $adress = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $response = Http::get($adress.$port."/toad/film/search",[
            'query' => $query
        ]);

        if ($response->successful()) {
            // Récupérer la liste des films retournés
            $films = $response->json(); // Pas besoin d'accéder à une clé 'data'
        } else {
            $films = [];
        }
    } else {
        // Si aucun terme de recherche n'est donné, récupérer tous les films
        //$response = Http::get('http://localhost:8080/toad/film/getbyid');
        $adress = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $response = Http::get($adress.$port."/toad/film/getbyid");
        
        if ($response->successful()) {
            // Récupérer tous les films
            $films = $response->json(); // Toujours pas de clé 'data' à accéder
        } else {
            $films = [];
        }
    }

    // Passer les films récupérés à la vue
    return view('catalogue', compact('films'));
}




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('films.create');  // Charge la vue create.blade.php
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Récupérer les données envoyées depuis le formulaire
        $data = $request->all();
        $adress = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $endpointAddFilm ='/toad/film/add';
        $servRequest = $adress.$port;
        $lastUpdate = Carbon::now()->format('Y-m-d H:i:s'); // Format attendu : 'YYYY-MM-DD HH:MM:SS'
   
        $data['lastUpdate'] = $lastUpdate;
        // Envoyer ces données à l’API Spring
        $response = Http::asForm()->post($servRequest.$endpointAddFilm,$data);
        Log::info('Données envoyées à l\'API :', $data);
        Log::info('Réponse de l\'API : ' . $response->body());
 
        // Vérifier si l'API a bien répondu
        if ($response->successful()) {
            return response()->json(['message' => 'Film ajouté avec succès !']);
        } else {
            return response()->json(['message' => 'Erreur lors de l\'ajout du film'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //$url = "http://localhost:8080/toad/film/getById?id={$id}";
        $adress = env('TOAD_SERVER');
        $port = env('TOAD_PORT');
        $url = $adress.$port."/toad/film/getById?id={$id}";
        $response = Http::get($url);

        dd($url);
        if ($response->ok()) {
            $film = $response->json();  
            return view('film-details', compact('film')); // Charge la vue film-details.blade.php
        }

        return redirect()->route('films.index')->withErrors('Film non trouvé.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Film $film)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        //
    }
}
