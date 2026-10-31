<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resultat;
use App\Models\RendezVous;
use App\Services\MailService;
use Illuminate\Support\Str;

class ResultatController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTE DES RÉSULTATS (ADMIN)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $resultats = Resultat::with('rendezvous')->latest()->get();
        return view('admin.resultats.index', compact('resultats'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULAIRE UPLOAD (ADMIN)
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $rendezvous = RendezVous::where('statut', 'confirme')->get();
        return view('admin.resultats.create', compact('rendezvous'));
    }

    /*
    |--------------------------------------------------------------------------
    | ENREGISTRER LE RÉSULTAT (ADMIN)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'rendezvous_id' => 'required|exists:rendezvous,id',
            'fichier_pdf'   => 'required|file|mimes:pdf|max:10240',
        ]);

        // Générer un code unique à 8 caractères
        $code = strtoupper(Str::random(8));

        // Sauvegarder le PDF
        $path = $request->file('fichier_pdf')->store('resultats', 'public');

        // Créer le résultat
        $resultat = Resultat::create([
            'rendezvous_id' => $request->rendezvous_id,
            'code_unique'   => $code,
            'fichier_pdf'   => $path,
        ]);

        // Envoyer le code par email au patient
        $rdv = RendezVous::find($request->rendezvous_id);

        if (!empty($rdv->email)) {
            $htmlBody = view('emails.resultat', [
                'rdv'  => $rdv,
                'code' => $code,
            ])->render();

            try {
                MailService::send(
                    $rdv->email,
                    'Vos résultats sont disponibles - Laboratoire Amitié',
                    $htmlBody
                );
            } catch (\Exception $e) {
                \Log::error('Erreur envoi email résultat: ' . $e->getMessage());
            }
        }

        return redirect('/admin/resultats')
            ->with('success', 'Résultat uploadé et code envoyé au patient ✅');
    }

    /*
    |--------------------------------------------------------------------------
    | PAGE DE TÉLÉCHARGEMENT (PATIENT)
    |--------------------------------------------------------------------------
    */
    public function telecharger(Request $request)
    {
        return view('resultats.telecharger');
    }

    /*
    |--------------------------------------------------------------------------
    | VÉRIFIER LE CODE ET TÉLÉCHARGER (PATIENT)
    |--------------------------------------------------------------------------
    */
    public function verifier(Request $request)
    {
        $request->validate([
            'code' => 'required|string|min:8|max:8',
        ]);

        $resultat = Resultat::where('code_unique', strtoupper($request->code))
                            ->with('rendezvous')
                            ->first();

        if (!$resultat) {
            return back()->with('error', 'Code invalide. Vérifiez votre email et réessayez.');
        }

        // Marquer comme téléchargé
        $resultat->update(['telecharge' => true]);

        // Télécharger le PDF
        $path = storage_path('app/public/' . $resultat->fichier_pdf);

        return response()->download($path, 'resultat_' . $resultat->code_unique . '.pdf');
    }
}