@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Détails de l'annonce -->
        <div class="">
            <div class="card shadow-sm">
                @if ($annonce->image)
                <img src="{{ asset('storage/' . $annonce->image) }}" class="card-img-top" alt="Image de l'annonce" style="width:auto; height: 600px;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $annonce->titre }}</h5>
                    <p class="card-text">{{ Str::limit($annonce->description, 100) }}</p>
                    <p class="text-muted">Prix : {{ $annonce->prix ?? 'N/A' }} €</p>
                    <p class="text-muted">Publié par : {{ $annonce->user->name }}</p>
                    <p class="text-muted">Catégorie : {{ $annonce->categorie->name }}</p>
                </div>
            </div>

        <!-- Formulaire pour ajouter un commentaire -->
        @auth
            <div class="bg-gray-50 p-4 rounded-md shadow-sm mt-4">
                <h4 class="text-xl font-semibold mb-2">Ajouter un commentaire</h4>
                <form action="{{ route('commentaires.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="annonce_id" value="{{ $annonce->id }}">
                    <div class="form-group mb-3">
                        <textarea name="contenu" class="form-control w-full p-3 border rounded-lg" placeholder="Écrire un commentaire..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2 px-6 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">Envoyer</button>
                </form>
            </div>
        @endauth

        <!-- Affichage des commentaires -->
        <h3 class="mt-6 text-xl font-semibold">Commentaires :</h3>
        @foreach($annonce->commentaires as $commentaire)
            <div class="border p-4 mb-4 rounded-md shadow-sm bg-white">
                <div class="flex justify-between items-center mb-2">
                    <strong class="text-lg">{{ $commentaire->user->name }}</strong>
                   
                  
                </div>

                <p class="text-gray-700 mb-3">{{ $commentaire->contenu }}</p>

                
                <div>
                @if(Auth::id() === $commentaire->user_id)
                <a href="{{ route('commentaires.edit', $commentaire->id) }}" class="btn btn-warning btn-sm text-white bg-yellow-600 hover:bg-yellow-700 rounded-md focus:outline-none">Modifier</a>
            @endif
                @if(Auth::id() === $commentaire->user_id)
                    <form action="{{ route('commentaires.destroy', $commentaire->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm text-white bg-red-600 hover:bg-red-700 rounded-md focus:outline-none">Supprimer</button>
                    </form>
                @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
