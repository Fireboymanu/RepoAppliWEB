@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Ajouter un DVD</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inventory.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="film_id">Sélectionnez un film :</label>
            <select name="film_id" id="film_id" class="form-control" required>
                <option value="">-- Choisissez un film --</option>
                @foreach($films as $film)
                    <option value="{{ $film['filmId'] }}">
                        {{ $film['title'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajouter le DVD</button>
    </form>
</div>
@endsection
