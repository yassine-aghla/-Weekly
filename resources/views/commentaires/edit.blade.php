@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Modifier le commentaire</h3>

        <form action="{{ route('commentaires.update', $commentaire->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <textarea name="contenu" class="form-control" rows="4" required>{{ $commentaire->contenu }}</textarea>
            </div>
            <button type="submit" class="btn btn-success mt-3">Mettre à jour le commentaire</button>
        </form>
    </div>
@endsection
