<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Film - {{ $film['title'] }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Modifier le Film: {{ $film['title'] }}</h1>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Success message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('Edit.update', ['id' => $film['filmId']]) }}" method="POST">

    @csrf
    @method('PUT') <!-- Use PUT method for updating -->

    <!-- Title -->
    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $film['title']) }}" required>
    </div>

    <!-- Description -->
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description">{{ old('description', $film['description']) }}</textarea>
    </div>

    <!-- Release Year -->
    <div class="mb-3">
        <label for="releaseYear" class="form-label">Année de sortie</label>
        <input type="number" class="form-control" id="releaseYear" name="releaseYear" value="{{ old('releaseYear', $film['releaseYear']) }}" required>
    </div>

    <!-- Language ID -->
    <div class="mb-3">
        <label for="languageId" class="form-label">ID Langue</label>
        <input type="number" class="form-control" id="languageId" name="languageId" value="{{ old('languageId', $film['languageId']) }}" required>
    </div>

    <!-- Original Language ID -->
    <div class="mb-3">
        <label for="originalLanguageId" class="form-label">ID Langue Originale</label>
        <input type="number" class="form-control" id="originalLanguageId" name="originalLanguageId" value="{{ old('originalLanguageId', $film['originalLanguageId']) }}" required>
    </div>

    <!-- Rental Duration -->
    <div class="mb-3">
        <label for="rentalDuration" class="form-label">Durée de location (jours)</label>
        <input type="number" class="form-control" id="rentalDuration" name="rentalDuration" value="{{ old('rentalDuration', $film['rentalDuration']) }}" required>
    </div>

    <!-- Rental Rate -->
    <div class="mb-3">
        <label for="rentalRate" class="form-label">Tarif de location</label>
        <input type="number" step="0.01" class="form-control" id="rentalRate" name="rentalRate" value="{{ old('rentalRate', $film['rentalRate']) }}" required>
    </div>

    <!-- Length -->
    <div class="mb-3">
        <label for="length" class="form-label">Durée (en minutes)</label>
        <input type="number" class="form-control" id="length" name="length" value="{{ old('length', $film['length']) }}" required>
    </div>

    <!-- Replacement Cost -->
    <div class="mb-3">
        <label for="replacementCost" class="form-label">Coût de remplacement</label>
        <input type="number" step="0.01" class="form-control" id="replacementCost" name="replacementCost" value="{{ old('replacementCost', $film['replacementCost']) }}" required>
    </div>

    <!-- Rating -->
    <div class="mb-3">
        <label for="rating" class="form-label">Classification</label>
        <select class="form-control" id="rating" name="rating" required>
            <option value="R" {{ old('rating', $film['rating']) == 'R' ? 'selected' : '' }}>R</option>
            <option value="G" {{ old('rating', $film['rating']) == 'G' ? 'selected' : '' }}>G</option>
            <option value="PG" {{ old('rating', $film['rating']) == 'PG' ? 'selected' : '' }}>PG</option>
            <option value="PG-13" {{ old('rating', $film['rating']) == 'PG-13' ? 'selected' : '' }}>PG-13</option>
            <option value="NC-17" {{ old('rating', $film['rating']) == 'NC-17' ? 'selected' : '' }}>NC-17</option>
        </select>
    </div>

    <!-- Last Update -->
    <div class="mb-3">
        <label for="lastUpdate" class="form-label">Dernière mise à jour</label>
        <input type="datetime-local" class="form-control" id="lastUpdate" name="lastUpdate" value="{{ old('lastUpdate', $film['lastUpdate']) }}" required>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Mettre à jour le film</button>
    <a href="{{ route('films.index') }}" class="btn btn-secondary">Retour au catalogue🏡</a>
</form>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    
</body>
</html>
