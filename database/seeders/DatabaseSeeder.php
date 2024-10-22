<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Contact;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //crea usuarios
        //$users = User::factory()->count(10)->create();

        // foreach ($users as $user) {
        //     // Crea contactos para cada usuario
        //     $contactUsers = $users->filter(fn($u) => $u->id !== $user->id)->random(3);

        //     foreach ($contactUsers as $contactUser) {
        //         Contact::create([
        //             'user_id' => $user->id,
        //             'id_contact' => $contactUser->id,
        //         ]);
        //     }
        // }        

         \App\Models\User::factory()->create([
             'username' => 'UserEN',
             'email' => 'user@english.com',
             'email_verified_at' => now(),
             'password' => Hash::make('english1'),
             'language' => fake()->randomElement(['EN_US']),
         ]);

         \App\Models\User::factory()->create([
            'username' => 'UsuarioES',
            'email' => 'user@español.com',
            'email_verified_at' => now(),
            'password' => Hash::make('español1'),
            'language' => fake()->randomElement(['ES']),
        ]);
    }
}
