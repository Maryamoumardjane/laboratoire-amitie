<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temoignage;

class TemoignageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SOUMETTRE UN TÉMOIGNAGE (PATIENT)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'nom'     => 'required|string|max:100',
            'email'   => 'nullable|email',
            'message' => 'required|string|max:500',
            'etoiles' => 'required|integer|min:1|max:5',
        ]);

        Temoignage::create([
            'nom'      => $request->nom,
            'email'    => $request->email,
            'message'  => $request->message,
            'etoiles'  => $request->etoiles,
            'approuve' => false,
        ]);

        return back()->with('success', 'Merci pour votre avis ! Il sera publié après validation. 🙏');
    }

    /*
    |--------------------------------------------------------------------------
    | LISTE ADMIN
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $temoignages = Temoignage::latest()->get();
        return view('admin.temoignages.index', compact('temoignages'));
    }

    /*
    |--------------------------------------------------------------------------
    | APPROUVER UN TÉMOIGNAGE (ADMIN)
    |--------------------------------------------------------------------------
    */
    public function approuver($id)
    {
        $temoignage = Temoignage::findOrFail($id);
        $temoignage->update(['approuve' => !$temoignage->approuve]);
        return back()->with('success', 'Statut mis à jour ✅');
    }

    /*
    |--------------------------------------------------------------------------
    | SUPPRIMER UN TÉMOIGNAGE (ADMIN)
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        Temoignage::destroy($id);
        return back()->with('success', 'Témoignage supprimé 🗑️');
    }
}