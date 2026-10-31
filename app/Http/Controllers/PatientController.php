<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{

    // LISTE
    public function index()
    {
        $patients = Patient::latest()->get();

        return view('patients.index', compact('patients'));
    }

    // FORMULAIRE
    public function create()
    {
        return view('patients.create');
    }

    // ENREGISTRER
    public function store(Request $request)
    {
        Patient::create($request->all());

        return redirect('/admin/patients')
            ->with('success', 'Patient ajouté');
    }

    // EDIT
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);

        return view('patients.edit', compact('patient'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $patient->update($request->all());

        return redirect('/admin/patients')
            ->with('success', 'Patient modifié');
    }

    // DELETE
    public function destroy($id)
    {
        Patient::destroy($id);

        return back()
            ->with('success', 'Patient supprimé');
    }

}