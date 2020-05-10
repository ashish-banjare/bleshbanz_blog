<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Users
        User::create(
            [
                'name' => 'GreatAdmin',
                'email' => 'admin@la.fr',
                'password' => bcrypt('admin'),
                'role' => 'admin',
                'valid' => true,
                'confirmed' => true,
                'remember_token' => str_random(10),
            ]
        );
        User::create(
            [
                'name' => 'GreatRedactor',
                'email' => 'redac@la.fr',
                'password' => bcrypt('redac'),
                'role' => 'redac',
                'valid' => true,
                'confirmed' => true,
                'remember_token' => str_random(10),
            ]
        );
        User::create(
            [
                'name' => 'Walker',
                'email' => 'walker@la.fr',
                'password' => bcrypt('walker'),
                'role' => 'user',
                'valid' => true,
                'confirmed' => true,
                'remember_token' => str_random(10),
            ]
        );
        User::create(
            [
                'name' => 'Slacker',
                'email' => 'slacker@la.fr',
                'password' => bcrypt('slacker'),
                'role' => 'user',
                'valid' => true,
                'confirmed' => true,
                'remember_token' => str_random(10),
            ]
        );
        User::create(
            [
                'name' => 'Worker',
                'email' => 'worker@la.fr',
                'password' => bcrypt('worker'),
                'role' => 'user',
                'valid' => false,
                'confirmed' => true,
                'remember_token' => str_random(10),
            ]
        );

        // Uncheck new for these users
        foreach(User::all() as $user) {
            $user->ingoing->delete();
        }

        $nbrUsers = 5;

        // Other users
        factory(User::class, 15)->create();
        sleep(2);
        User::create(
            [
                'name' => 'Sorditofublos',
                'email' => 'sordi@la.fr',
                'password' => bcrypt('sordi'),
                'role' => 'user',
                'valid' => true,
                'confirmed' => true,
                'remember_token' => str_random(10),
            ]
        );
        $user = User::create(
            [
                'name' => 'Martinobinus',
                'email' => 'martin@la.fr',
                'password' => bcrypt('martin'),
                'role' => 'user',
                'valid' => false,
                'confirmed' => false,
                'remember_token' => str_random(10),
            ]
        );
        $user->ingoing->delete();
    }
}
