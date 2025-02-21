@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Liste des Annonces</h1>
<div class="d-flex justify-content-between text-end mb-3">
    <div class="text-end mb-3">
        <a href="{{ route('annonces.create') }}" class="btn btn-primary">+ Ajouter une annonce</a>
    </div>
    <div class="text-end mb-3">
        <a href="{{ route('annonces.archives') }}" class="btn btn-primary">annonce Archives</a>
    </div>
    <div class="text-end mb-3">
        <a href="{{ route('categories.index') }}" class="btn btn-primary">Ajouter Categorie</a>
    </div>
</div>

    <div class="row">
        @foreach ($annonces as $annonce)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    @if ($annonce->image)
                        <img src="{{ asset('storage/' . $annonce->image) }}" class="card-img-top" alt="Image de l'annonce">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $annonce->titre }}</h5>
                        <p class="card-text">{{ Str::limit($annonce->description, 100) }}</p>
                        <p class="text-muted">Prix : {{ $annonce->prix ?? 'N/A' }} €</p>
                        <p class="text-muted">Publié par : {{ $annonce->user->name }}</p>
                        <p class="text-muted">Catégorie : {{ $annonce->categorie->name }}</p>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('annonces.show', $annonce) }}" class="btn btn-success btn-sm">voir</a>
                            @if(Auth::id() === $annonce->user_id)
                                <a href="{{ route('annonces.edit', $annonce) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('annonces.destroy', $annonce) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous supprimer cette annonce ?')">Supprimer</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-3">
        {{ $annonces->links() }}
    </div>
</div>
@endsection
