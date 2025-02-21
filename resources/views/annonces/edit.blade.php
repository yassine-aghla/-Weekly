@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-dark text-center">
                    <h3>Modifier l'Annonce</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('annonces.update', $annonce) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Titre :</label>
                            <input type="text" name="titre" class="form-control" value="{{ $annonce->titre }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description :</label>
                            <textarea name="description" class="form-control" rows="4" required>{{ $annonce->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prix :</label>
                            <input type="number" name="prix" class="form-control" value="{{ $annonce->prix }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Image :</label>
                            <input type="file" name="image" class="form-control">
                            @if ($annonce->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $annonce->image) }}" class="img-fluid rounded shadow" width="150">
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catégorie :</label>
                            <select name="categorie_id" class="form-select">
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ $annonce->categorie_id == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
