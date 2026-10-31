<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RendezVous;
use App\Models\Examen;
use App\Http\Requests\StoreRendezVousRequest;
use Illuminate\Database\QueryException;
use App\Services\MailService;
use App\Services\WhatsappService;

class RendezVousController extends Controller
{
    public function index()
    {
        $rendezvous = RendezVous::latest()->get();
        return view('rendezvous.index', compact('rendezvous'));
    }

    public function create()
    {
        $examens = Examen::all();
        return view('rendezvous.create', compact('examens'));
    }

    public function store(StoreRendezVousRequest $request)
    {
        try {
            $rdv = RendezVous::create([
                'nom'       => $request->nom,
                'telephone' => $request->telephone,
                'email'     => $request->email,
                'examen_id' => $request->examen_id,
                'date_rdv'  => $request->date_rdv,
                'heure_rdv' => $request->heure_rdv,
                'statut'    => 'en_attente',
            ]);

            return redirect(url()->previous() . '#rendezvous')
                ->with('success', 'Rendez-vous créé avec succès 👍');

        } catch (QueryException $e) {
            return redirect(url()->previous() . '#rendezvous')
                ->with('error', 'Ce créneau est déjà réservé ❌');
        }
    }

    public function edit($id)
    {
        $rdv     = RendezVous::findOrFail($id);
        $examens = Examen::all();
        return view('rendezvous.edit', compact('rdv', 'examens'));
    }

    public function update(Request $request, $id)
    {
        $rdv = RendezVous::findOrFail($id);
        $rdv->update([
            'nom'       => $request->nom,
            'telephone' => $request->telephone,
            'email'     => $request->email,
            'examen_id' => $request->examen_id,
            'date_rdv'  => $request->date_rdv,
            'heure_rdv' => $request->heure_rdv,
            'statut'    => $request->statut,
        ]);
        return redirect('/admin/rendezvous')->with('success', 'Rendez-vous modifié 👍');
    }

    public function destroy($id)
    {
        RendezVous::destroy($id);
        return redirect('/admin#liste-rendezvous')->with('success', 'Rendez-vous supprimé 🗑️');
    }

    public function events()
    {
        $events = RendezVous::all()->map(function ($rdv) {
            return [
                'id'    => $rdv->id,
                'title' => $rdv->nom . ' - ' . ($rdv->examen->nom ?? 'Examen'),
                'start' => $rdv->date_rdv . 'T' . $rdv->heure_rdv,
                'color' => $this->getColor($rdv->statut),
            ];
        });
        return response()->json($events);
    }

    private function getColor($statut)
    {
        return match ($statut) {
            'confirme' => '#00c853',
            'annule'   => '#ff0000',
            default    => '#ff9800',
        };
    }

    public function updateStatut(Request $request, $id)
    {
        $rdv         = RendezVous::findOrFail($id);
        $rdv->statut = $request->statut;
        $rdv->save();
        $rdv->load('examen');

        $emailMsg   = '';
        $waTemplate = '';
        $waParams   = [];
        $waText     = '';

        if ($request->statut == 'confirme') {

            // ── Email ──
            $emailMsg = "Votre rendez-vous du {$rdv->date_rdv} à {$rdv->heure_rdv} "
                      . "pour l'examen <strong>{$rdv->examen->nom}</strong> est confirmé.";

            // ── WhatsApp template "modle_1" (confirmation) ──
            // Variables : {{1}}=nom, {{2}}=examen, {{3}}=date, {{4}}=heure
            $waTemplate = 'modle_1';
            $waParams   = [
                $rdv->nom,
                $rdv->examen->nom,
                $rdv->date_rdv,
                $rdv->heure_rdv,
            ];

            // ── Texte libre (fallback si template non approuvé) ──
            $waText = "╔══════════════════════════╗\n"
                    . "🏥  *LABORATOIRE DE L'AMITIÉ*\n"
                    . "╚══════════════════════════╝\n\n"
                    . "Bonjour *{$rdv->nom}* 👋\n\n"
                    . "🎉 *Bonne nouvelle !*\n"
                    . "Votre rendez-vous est officiellement *CONFIRMÉ* ✅\n\n"
                    . "━━━━━━━━━━━━━━━━━━━━━━━━\n"
                    . "📋 *Détails de votre RDV*\n"
                    . "━━━━━━━━━━━━━━━━━━━━━━━━\n"
                    . "🔬 *Examen :* {$rdv->examen->nom}\n"
                    . "📅 *Date :* {$rdv->date_rdv}\n"
                    . "🕐 *Heure :* {$rdv->heure_rdv}\n"
                    . "━━━━━━━━━━━━━━━━━━━━━━━━\n\n"
                    . "📌 *Rappels importants :*\n"
                    . "▪️ Arrivez 10 min avant l'heure\n"
                    . "▪️ Apportez votre pièce d'identité\n"
                    . "▪️ Venez à jeun si nécessaire\n\n"
                    . "💬 Des questions ? Répondez à ce message.\n\n"
                    . "Merci de votre confiance ! 🙏\n"
                    . "━━━━━━━━━━━━━━━━━━━━━━━━\n"
                    . "_Laboratoire de l'Amitié_\n"
                    . "_📍 Votre santé, notre priorité_ 💙";

        } elseif ($request->statut == 'annule') {

            // ── Email ──
            $emailMsg = "Votre rendez-vous du {$rdv->date_rdv} "
                      . "pour l'examen <strong>{$rdv->examen->nom}</strong> a été annulé.";

            // ── WhatsApp template "modele2" (annulation) ──
            // Variables : {{1}}=nom, {{2}}=examen, {{3}}=date
            $waTemplate = 'modele2';
            $waParams   = [
                $rdv->nom,
                $rdv->examen->nom,
                $rdv->date_rdv,
            ];

            // ── Texte libre (fallback si template non approuvé) ──
            $waText = "╔══════════════════════════╗\n"
                    . "🏥  *LABORATOIRE DE L'AMITIÉ*\n"
                    . "╚══════════════════════════╝\n\n"
                    . "Bonjour *{$rdv->nom}* 👋\n\n"
                    . "⚠️ *Information importante*\n"
                    . "Votre rendez-vous a été *ANNULÉ* ❌\n\n"
                    . "━━━━━━━━━━━━━━━━━━━━━━━━\n"
                    . "📋 *RDV concerné*\n"
                    . "━━━━━━━━━━━━━━━━━━━━━━━━\n"
                    . "🔬 *Examen :* {$rdv->examen->nom}\n"
                    . "📅 *Date :* {$rdv->date_rdv}\n"
                    . "━━━━━━━━━━━━━━━━━━━━━━━━\n\n"
                    . "🔄 *Que faire maintenant ?*\n"
                    . "▪️ Répondez à ce message\n"
                    . "▪️ Ou appelez-nous pour reprogrammer\n"
                    . "▪️ Nous restons disponibles pour vous\n\n"
                    . "Nous nous excusons pour la gêne occasionnée 🙏\n\n"
                    . "━━━━━━━━━━━━━━━━━━━━━━━━\n"
                    . "_Laboratoire de l'Amitié_\n"
                    . "_📍 Votre santé, notre priorité_ 💙";
        }

        // ── Envoi EMAIL ──
        if ($emailMsg !== '') {
            try {
                $htmlBody = view('emails.rendezvous', [
                    'rdv'            => $rdv,
                    'messageContent' => $emailMsg,
                ])->render();

                MailService::send(
                    $rdv->email,
                    'Mise à jour de votre rendez-vous - Laboratoire Amitié',
                    $htmlBody
                );
            } catch (\Exception $e) {
                \Log::error('Erreur email: ' . $e->getMessage());
            }
        }

        // ── Envoi WhatsApp ──
        // Envoie directement le message texte professionnel
        if ($waText !== '' && $rdv->telephone) {
            try {
                WhatsappService::sendText($rdv->telephone, $waText);
            } catch (\Exception $e) {
                \Log::error('Erreur WhatsApp: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Statut mis à jour — email + WhatsApp envoyés ✅');
    }
}