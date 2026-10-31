<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\RendezVous;
use App\Models\Contact;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ✅ Partage les données globales avec toutes les vues
        View::composer('*', function ($view) {
            $enAttenteCount = RendezVous::where('statut', 'en_attente')->count();
            $messagesNonLus = Contact::where('lu', false)->count();
            $view->with('enAttenteGlobal', $enAttenteCount);
            $view->with('messagesNonLus', $messagesNonLus);
        });
    }
}