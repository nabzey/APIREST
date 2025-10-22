<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comptes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('numero_compte')->unique();
            $table->enum('type', ['courant', 'epargne', 'entreprise']);
            $table->enum('statut', ['actif', 'bloque', 'ferme']);
            $table->decimal('solde', 15, 2)->default(0);
            $table->foreignUuid('client_id')->constrained('clients')->onDelete('cascade');
            $table->timestamps();

            // Index pour optimiser les recherches
            $table->index(['type', 'statut']);
            $table->index('numero_compte');
            $table->index('client_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};
