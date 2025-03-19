<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Stock</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Modifier le Stock du Film</h1>

        <div class="card shadow-sm p-4">
            <h2 class="mb-3">{{ $film['title'] }}</h2>
            <p><strong>Adresse :</strong> {{ $film['address'] }} ({{ $film['district'] }})</p>
            <p><strong>Quantité actuelle :</strong> {{ $film['quantity'] }}</p>

            <form action="{{ route('inventory.update', ['id' => $film['filmId']]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="quantity" class="form-label">Nouvelle Quantité</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" value="{{ $film['quantity'] }}" required min="0">
                </div>

                <button type="submit" class="btn btn-primary">Mettre à Jour</button>
                <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
