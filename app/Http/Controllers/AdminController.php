<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\Examen;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $rendezvousCount = RendezVous::count();
        $examensCount    = Examen::count();
        $patientsCount   = 0;

        $confirmeCount  = RendezVous::where('statut', 'confirme')->count();
        $annuleCount    = RendezVous::where('statut', 'annule')->count();
        $enAttenteCount = RendezVous::where('statut', 'en_attente')->count();

        $rendezvous = RendezVous::latest()->get();

        $todayRendezvous = RendezVous::whereDate('date_rdv', Carbon::today())
            ->orderBy('heure_rdv', 'asc')
            ->get();

        $stats = [
            'rendezvous' => $rendezvousCount,
            'examens'    => $examensCount,
            'patients'   => $patientsCount,
        ];

        // ✅ Statistiques mensuelles (12 derniers mois)
        $moisLabels = [];
        $moisData   = [];

        for ($i = 11; $i >= 0; $i--) {
            $mois = Carbon::now()->subMonths($i);
            $moisLabels[] = $mois->locale('fr')->monthName . ' ' . $mois->year;
            $moisData[] = RendezVous::whereYear('date_rdv', $mois->year)
                ->whereMonth('date_rdv', $mois->month)
                ->count();
        }

        return view('admin.dashboard', compact(
            'rendezvousCount',
            'examensCount',
            'patientsCount',
            'confirmeCount',
            'annuleCount',
            'enAttenteCount',
            'rendezvous',
            'todayRendezvous',
            'stats',
            'moisLabels',
            'moisData'
        ));
    }
}