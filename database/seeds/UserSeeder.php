<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'RH',
            'email' => 'test@test.test',
            'email_verified_at' => now(),
            'password' => 'testtest',
            'name' => 'RH',
            'email' => 'radwimrh@gmail.com',
            'email_verified_at' => now(),
            'password' => '52375237',
        ]);
    }
}
