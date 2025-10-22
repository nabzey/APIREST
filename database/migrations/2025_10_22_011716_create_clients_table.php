<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nom');
            $table->string('email')->unique();
            $table->string('telephone');
            $table->timestamps();

            // Ajouter des index pour optimiser les recherches
            $table->index('nom');
            $table->index('email');
            $table->index('telephone');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
