<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $annonces = Annonce::all();

        if ($users->isEmpty() || $annonces->isEmpty()) {
            return;
        }

        foreach ($annonces as $annonce) {
            Commentaire::create([
                'contenu' => 'Ceci est un commentaire de test.',
                'user_id' => $users->random()->id,
                'annonce_id' => $annonce->id,
            ]);
        }
    }
}
