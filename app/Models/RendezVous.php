<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    protected $table = 'rendezvous';

   protected $fillable = [
   'nom',
    'telephone',
        'email',
    'examen_id',
    'date_rdv',
    'heure_rdv',
    'statut'   // ✅ corrigé
];
    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }
}