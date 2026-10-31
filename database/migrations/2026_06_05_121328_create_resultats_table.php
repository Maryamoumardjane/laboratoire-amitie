<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resultats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rendezvous_id')->constrained('rendezvous')->onDelete('cascade');
            $table->string('code_unique', 10)->unique(); // code envoyé au patient
            $table->string('fichier_pdf');               // chemin du PDF uploadé
            $table->boolean('telecharge')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resultats');
    }
};