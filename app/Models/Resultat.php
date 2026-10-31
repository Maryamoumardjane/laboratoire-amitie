<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resultat extends Model
{
    protected $fillable = [
        'rendezvous_id',
        'code_unique',
        'fichier_pdf',
        'telecharge',
    ];

    public function rendezvous()
    {
        return $this->belongsTo(RendezVous::class);
    }
}