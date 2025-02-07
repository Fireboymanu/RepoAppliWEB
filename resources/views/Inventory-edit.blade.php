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
        <h1 class="text-center mb-4">📝 Modifier le Stock</h1>

        <form action="{{ route('inventory.update', $item['filmId']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Titre du Film</label>
                <input type="text" class="form-control" id="title" value="{{ $item['title'] }}" disabled>
            </div>

            <div class="mb-3">
                <label for="state" class="form-label">État du Stock</label>
                <input type="text" class="form-control" id="state" name="state" value="{{ $item['state'] }}" required>
            </div>

            <button type="submit" class="btn btn-success">Mettre à jour</button>
            <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
