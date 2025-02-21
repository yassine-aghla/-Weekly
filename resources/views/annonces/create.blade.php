@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Créer une Annonce</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('annonces.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Titre :</label>
                            <input type="text" name="titre" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description :</label>
                            <textarea name="description" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prix :</label>
                            <input type="number" name="prix" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Image :</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catégorie :</label>
                            <select name="categorie_id" class="form-select">
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Créer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
