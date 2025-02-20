<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request, Category $category)
    {
      

        $category->create($request->validated());
        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succès');
    }

    public function edit(Category $category)
    {
       
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
       
        $category->update($request->validated());
        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès');
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès');
    }
}
