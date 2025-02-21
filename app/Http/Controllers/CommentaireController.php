<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Http\Requests\CommentaireRequest;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    public function store(CommentaireRequest $request)
    {
        Commentaire::create([
            'contenu' => $request->contenu,
            'user_id' => Auth::id(),
            'annonce_id' => $request->annonce_id,
        ]);

        return back()->with('success', 'Commentaire ajouté avec succès.');
    }

    public function destroy(Commentaire $commentaire)
    {
        if (Auth::id() !== $commentaire->user_id) {
            return back()->with('error', 'Vous ne pouvez supprimer que vos propres commentaires.');
        }

        $commentaire->delete();
        return back()->with('success', 'Commentaire supprimé.');
    }

    public function edit($id)
    {
  
        $commentaire = Commentaire::findOrFail($id);

        if (Auth::id() !== $commentaire->user_id) {
            return back()->with('error', 'Vous ne pouvez modifier que vos propres commentaires.');
        }

        return view('commentaires.edit', compact('commentaire'));
    }

    
    public function update(CommentaireRequest $request, $id)
    {
        $commentaire = Commentaire::findOrFail($id);
     
       
        if (Auth::id() !== $commentaire->user_id) {
            return back()->with('error', 'Vous ne pouvez modifier que vos propres commentaires.');
        }

     
        $commentaire->update([
            'contenu' => $request->contenu,
        ]);
          
       


        return redirect()->route('annonces.show')
            ->with('success', 'Commentaire mis à jour avec succès.');
    }
}
