<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Film</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
    <h1>{{ $film['title'] }}</h1>
        <p><strong>Description :</strong> {{ $film['description'] }}</p>
        <p><strong>Année de sortie :</strong> {{ $film['releaseYear'] }}</p>
        <p><strong>Durée :</strong> {{ $film['length'] }} minutes</p>
        <p><strong>Note :</strong> {{ $film['rating'] }}</p>
        <p><strong>Durée de remplacement :</strong> {{ $film['rentalDuration'] }}H</p>
        <p><strong>Dernière mise à jour :</strong> {{ $film['lastUpdate'] }}</p>
        <a href="{{ route('films.index') }}" class="btn btn-primary">Retour au catalogue🏡</a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
