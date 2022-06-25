<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\User;
use App\Models\Profile;
use App\Models\Experience;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
             'name' => 'Sylvain Macabrey',
             'email' => 'sylvain.macabrey@gmail.com',
        ]);

        $profil = Profile::factory()->create([
            'user_id' => $user->id
        ]);

        Experience::factory(5)->create([
            'profile_id' => $profil->id
        ]);

        Link::factory(3)->create([
            'profile_id' => $profil->id
        ]);
    }
}
