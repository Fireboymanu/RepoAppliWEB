<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le stock des films - {{ $film['title'] }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Modifier le stock du film : {{ $film['title'] }}</h1>

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
        <form action="{{ route('inventory.update', $film['filmId']) }}" method="POST">
            @csrf
            @method('PUT') <!-- Use PUT method for updating -->

            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $film['title']) }}" readonly>
            </div>

            <!-- Quantity -->
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantité en stock</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $film['quantity']) }}" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Mettre à jour le stock</button>
            <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Retour à l'inventaire</a>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
