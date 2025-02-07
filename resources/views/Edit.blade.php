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

        <!-- Form to update the film -->
        <form action="{{ route('Edit.update', $film['filmId']) }}" method="POST">
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

            <!-- Length -->
            <div class="mb-3">
                <label for="length" class="form-label">Durée (en minutes)</label>
                <input type="number" class="form-control" id="length" name="length" value="{{ old('length', $film['length']) }}" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Mettre à jour le Film</button>
            <a href="{{ route('films.index') }}" class="btn btn-secondary">Retour au catalogue🏡</a>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
