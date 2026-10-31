<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use Illuminate\Http\Request;

class ExamenController extends Controller
{
public function indexAdmin()
{
   $examens = Examen::orderBy('categorie')
                  ->orderBy('nom')
                  ->get();

    return view('admin.examens', compact('examens'));
}

    public function index(Request $request)
    {
        $query = Examen::query();

        // recherche
        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        // filtre catégorie
        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }
$examens = Examen::orderBy('categorie')
                  ->orderBy('nom')
                  ->get()
                  ->groupBy('categorie');
        $categories = Examen::select('categorie')
            ->distinct()
            ->pluck('categorie');

        return view('examens', compact('examens', 'categories'));
    }

    // formulaire ajout
    public function create()
    {
       return view('examens.create');
    }

    // enregistrer
    public function store(Request $request)
    {
        Examen::create([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'delai' => $request->delai,
            'categorie' => $request->categorie
        ]);

        return redirect('/admin/examens')
            ->with('success', 'Examen ajouté ✅');
    }

    // formulaire modifier
    public function edit($id)
    {
        $examen = Examen::findOrFail($id);

        return view('examens.edit', compact('examen'));
    }

    // update
    public function update(Request $request, $id)
    {
        $examen = Examen::findOrFail($id);

        $examen->update([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'delai' => $request->delai,
            'categorie' => $request->categorie
        ]);

        return redirect('/admin/examens')
            ->with('success', 'Examen modifié ✏️');
    }

    // supprimer
    public function destroy($id)
    {
        Examen::destroy($id);

        return redirect('/admin/examens')
            ->with('success', 'Examen supprimé 🗑️');
    }
}