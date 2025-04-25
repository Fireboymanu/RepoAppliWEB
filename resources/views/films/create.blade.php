<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Film</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Ajouter un Film 🎬</h1>

        <!-- Affichage des erreurs de validation -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Message de succès -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulaire d'ajout d'un film -->
        <form action="{{ route('films.store') }}" method="POST">
            @csrf <!-- Protection CSRF -->

            <!-- Titre -->
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div>

            <!-- Durée -->
            <div class="mb-3">
                <label for="length" class="form-label">Durée (en minutes)</label>
                <input type="number" class="form-control" id="length" name="length" value="{{ old('length') }}" required>
            </div>

            <!-- Durée de location -->
            <div class="mb-3">
                <label for="rentalDuration" class="form-label">Durée de location (jours)</label>
                <input type="number" class="form-control" id="rentalDuration" name="rentalDuration" 
                       value="{{ old('rentalDuration') }}" required>
            </div>

            <!-- Année de sortie -->
            <div class="mb-3">
                <label for="releaseYear" class="form-label">Année de sortie</label>
                <input type="number" class="form-control" id="releaseYear" name="releaseYear" 
                       value="{{ old('releaseYear') }}" required>
            </div>

            <!-- Classification -->
            <div class="mb-3">
                <label for="rating" class="form-label">Classification</label>
                <select class="form-control" id="rating" name="rating" required>
                    <option value="R" {{ old('rating') == 'R' ? 'selected' : '' }}>R</option>
                    <option value="G" {{ old('rating') == 'G' ? 'selected' : '' }}>G</option>
                    <option value="PG" {{ old('rating') == 'PG' ? 'selected' : '' }}>PG</option>
                    <option value="PG-13" {{ old('rating') == 'PG-13' ? 'selected' : '' }}>PG-13</option>
                    <option value="NC-17" {{ old('rating') == 'NC-17' ? 'selected' : '' }}>NC-17</option>
                </select>
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="btn btn-success">Ajouter un Film</button>
        </form>

        <!-- Bouton retour vers le catalogue -->
        <a href="{{ route('films.index') }}" class="btn btn-secondary mt-3">Retour au catalogue🏡</a>
    </div>
</body>
</html>
