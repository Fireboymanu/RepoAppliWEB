<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des Films</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">🎬 Catalogue des Films</h1>

        <!-- Formulaire de recherche -->
        <form action="{{ route('films.search') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Rechercher un film..." value="{{ request('query') }}">
                <button class="btn btn-primary" type="submit">Rechercher</button>
            </div>
        </form>

        <div class="row">
            @foreach($films as $film)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $film['title'] }}</h5>
                            <p><strong>Sortie :</strong> {{ $film['releaseYear'] }}</p>
                            

                            <!-- Liens vers les actions -->
                            <a href="{{ route('films.show', $film['filmId']) }}" class="btn btn-primary">Détails 🎥🍿</a>
                            <a href="{{ route('Edit.edit', ['id' => $film['filmId']]) }}" class="btn btn-warning">Modifier 🎥✏️</a>
                            <a href="{{ route('films.create') }}" class="btn btn-success">Ajouter un film 🎥✏️🍿</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
