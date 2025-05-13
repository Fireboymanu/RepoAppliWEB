<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;




Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

/*Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/

Route::get('/', function () {
    return view('login_staff');
});
Route::post('/login_staff', [LoginController::class, 'login'])->name('login_staff');

// Route pour afficher le catalogue
Route::get('/films', [FilmController::class, 'index'])->name('films.index');

//Route pour la création d'un film
Route::get('/films/create', [FilmController::class, 'create'])->name('films.create');

// Route pour afficher les détails d'un film
Route::get('/films/{id}', [FilmController::class, 'show'])->name('films.show');

Route::post('/films', [FilmController::class, 'store'])->name('films.store');

// Route pour faire une recherche grâce à la barre de recherche
Route::get('/films/search', [FilmController::class, 'search'])->name('films.search');

// Route to show the form for editing a film
Route::get('/films/{id}/edit', [EditController::class, 'edit'])->name('Edit.edit');

// Route to update the film (this matches the form's action URL)
Route::put('/films/{id}/edit', [EditController::class, 'update'])->name('Edit.update');


Route::get('/dashboard', function () {
    return view('dashboard'); // Assure-toi que cette vue existe
})->middleware(['auth', 'verified'])->name('dashboard');


//Route pour afficher la view inventory ainsi que pour la modification du stock etc.
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/inventory/{id}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
Route::put('/inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update');


Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');
Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');





//require __DIR__.'/auth.php';
