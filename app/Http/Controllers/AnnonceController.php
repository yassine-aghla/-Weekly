<?php
namespace App\Http\Controllers;
use App\Models\Annonce;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnonceController extends Controller
{
    public function index()
    {
        $annonces = Annonce::with(['user', 'categorie'])->whereNull('deleted_at')->latest()->paginate(3);
        return view('annonces.index', compact('annonces'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('annonces.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required',
            'prix' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['status'] = 'actif';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('annonces', 'public');
        }

        Annonce::create($data);
        return redirect()->route('annonces.index')->with('success', 'Annonce créée avec succès.');
    }

    public function edit(Annonce $annonce)
    {
        $categories = Category::all();
        return view('annonces.edit', compact('annonce', 'categories'));
    }

    public function update(Request $request, Annonce $annonce)
    {
        if ($annonce->user_id !== Auth::id()) {
            return redirect()->route('annonces.index')->with('error', 'Vous n\'avez pas l\'autorisation.');
        }
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required',
            'prix' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('annonces', 'public');
        }

        $annonce->update($data);
        return redirect()->route('annonces.index')->with('success', 'Annonce mise à jour.');
    }

    public function destroy(Annonce $annonce)
    {

        if ($annonce->user_id !== Auth::id()) {
            return redirect()->route('annonces.index')->with('error', 'Vous n\'avez pas l\'autorisation.');
        }
        $annonce->delete(); 
        return redirect()->route('annonces.index')->with('success', 'Annonce supprimée.');
    }

    public function archives()
{
    $annonces = Annonce::onlyTrashed()->paginate(3);
    return view('annonces.archives', compact('annonces'));
}

    public function show(Annonce $annonce)
    {
        
        $annonce->load('commentaires.user');

        return view('annonces.show', compact('annonce'));
    }

public function restore($id)
{
    $annonce = Annonce::onlyTrashed()->findOrFail($id);
    $annonce->restore();
    return redirect()->route('annonces.archives')->with('success', 'Annonce restaurée avec succès.');
}

}
