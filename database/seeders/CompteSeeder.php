<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer des comptes pour les clients existants
        $clients = \App\Models\Client::all();

        if ($clients->isEmpty()) {
            // Si aucun client n'existe, créer d'abord des clients
            $clients = \App\Models\Client::factory(5)->create();
        }

        // Créer plusieurs comptes par client
        foreach ($clients as $client) {
            \App\Models\Compte::factory()->create([
                'client_id' => $client->id,
                'type' => 'courant',
                'statut' => 'actif',
            ]);

            // Certains clients ont un compte épargne
            if (rand(0, 1)) {
                \App\Models\Compte::factory()->create([
                    'client_id' => $client->id,
                    'type' => 'epargne',
                    'statut' => 'actif',
                ]);
            }

            // Quelques comptes bloqués ou fermés pour la diversité
            if (rand(0, 4) === 0) {
                \App\Models\Compte::factory()->bloque()->create([
                    'client_id' => $client->id,
                ]);
            }
        }
    }
}
