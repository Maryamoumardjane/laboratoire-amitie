<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRendezVousRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string',
            'telephone' => 'required|string|min:8|max:15',
            'examen_id' => 'required|exists:examens,id',
            'date_rdv' => 'required|date',
            'heure_rdv' => 'required'
        ];
    }
}