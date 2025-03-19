<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock des Films</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">🎬 Stock des Films</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('errors'))
            <div class="alert alert-danger">
                {{ session('errors')->first() }}
            </div>
        @endif

        <div class="row">
            @foreach($inventory as $item)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['title'] }}</h5>
                            <p><strong>Sortie :</strong> {{ $item['releaseYear'] }}</p>
                            <p><strong>Stock disponible :</strong> {{ $item['quantity'] }} exemplaires</p>

                            @if($item['quantity'] == 0)
                                <p class="text-danger">Rupture de stock</p>
                            @else
                                <p class="text-success">Disponible</p>
                            @endif

                            <!-- Modifier le stock -->
                            <a href="{{ route('inventory.edit', $item['filmId']) }}" class="btn btn-warning btn-sm">
                                Modifier le stock
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
