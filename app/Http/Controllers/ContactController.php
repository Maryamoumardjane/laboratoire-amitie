<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MailService;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'prenom'    => 'required|string|max:100',
            'nom'       => 'required|string|max:100',
            'telephone' => 'required|string|max:20',
            'objet'     => 'required|string',
            'message'   => 'required|string|max:1000',
        ]);

        // ✅ Sauvegarder en base de données
        Contact::create([
            'prenom'    => $request->prenom,
            'nom'       => $request->nom,
            'telephone' => $request->telephone,
            'objet'     => $request->objet,
            'message'   => $request->message,
        ]);

        // ✅ Envoyer par email
        $htmlBody = "
            <h2>Nouveau message de contact</h2>
            <p><strong>Prénom :</strong> {$request->prenom}</p>
            <p><strong>Nom :</strong> {$request->nom}</p>
            <p><strong>Téléphone :</strong> {$request->telephone}</p>
            <p><strong>Objet :</strong> {$request->objet}</p>
            <p><strong>Message :</strong> {$request->message}</p>
        ";

        try {
            MailService::send(
                env('MAIL_FROM_ADDRESS'),
                'Nouveau message de contact - ' . $request->objet,
                $htmlBody
            );
        } catch (\Exception $e) {
            \Log::error('Erreur email contact: ' . $e->getMessage());
        }

        return back()->with('success', 'Votre message a été envoyé avec succès ! Nous vous répondrons sous 24h. ✅');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN — LISTE DES MESSAGES
    |--------------------------------------------------------------------------
    */
    public function adminIndex()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN — MARQUER COMME LU
    |--------------------------------------------------------------------------
    */
    public function marquerLu($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['lu' => !$contact->lu]);
        return back()->with('success', 'Statut mis à jour ✅');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN — SUPPRIMER
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        Contact::destroy($id);
        return back()->with('success', 'Message supprimé 🗑️');
    }
}