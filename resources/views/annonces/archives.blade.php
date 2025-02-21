@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Annonces supprimées</h1>
    <a href="{{ route('annonces.index') }}" class="btn btn-secondary mb-3">Retour aux annonces</a>

    <div class="row">
        @if ($annonces->isEmpty())
            <div>
                <p>Vous n'avez aucune annonce archivée.</p>
            </div>
        @else
            @foreach ($annonces as $annonce)
                @if(Auth::id() === $annonce->user_id)
                    <div class="col-md-4 mb-4">
                        <div class="card border-danger">
                            <div class="card-body">
                                <h5 class="card-title">{{ $annonce->titre }}</h5>
                                <p class="card-text">{{ Str::limit($annonce->description, 100) }}</p>
    
                                <form action="{{ route('annonces.restore', $annonce->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Restaurer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>

    <div class="mt-3">
        {{ $annonces->links() }}
    </div>
</div>
@endsection
