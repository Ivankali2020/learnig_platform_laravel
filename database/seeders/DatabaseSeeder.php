<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'ivanphyo',
            'email' => 'ivanphyo2015@gmail.com',
            'email_verified_at' => now(),
            'role' => '1',
            'password' => Hash::make('ivan2020'), // password
            'remember_token' => Str::random(10),
        ]);

        DB::table('wallets')->insert([
            'user_id' => '1',
            'wallet_unique_id' => uniqid().uniqid(),
            'money' => 500000,
        ]);

        $categories = ['sport','clothes','phone','laptop','food','earphone','book','pen','bike','car'];

        foreach ($categories as $c){
            DB::table('categories')->insert([
                'name' => $c,
            ]);
        };

        \App\Models\User::factory(10)->create();
        \App\Models\Course::factory(10)->create();



    }
}
