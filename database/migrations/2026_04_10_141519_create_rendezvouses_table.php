<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ─── TABLE EXAMENS ───────────────────────────────────
        Schema::create('examens', function (Blueprint $table) {
            $table->id();
            $table->string('categorie');
            $table->string('nom');
            $table->integer('prix');
            $table->string('delai');
            $table->timestamps();
        });

        // ─── TABLE RENDEZVOUS ────────────────────────────────
        Schema::create('rendezvous', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('telephone');
            $table->string('email')->nullable();
            $table->unsignedBigInteger('examen_id');
            $table->date('date_rdv');
            $table->time('heure_rdv');
            $table->string('status')->default('en_attente');
            $table->string('statut')->default('en_attente');
            $table->timestamps();

            $table->foreign('examen_id')
                  ->references('id')
                  ->on('examens')
                  ->onDelete('cascade');

            $table->unique(['date_rdv', 'heure_rdv']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rendezvous');
        Schema::dropIfExists('examens');
    }
};