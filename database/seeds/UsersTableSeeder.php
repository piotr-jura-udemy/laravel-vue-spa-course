<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create(['email' => 'john@laravel.test']);
        factory(User::class, 9)->create();
        factory(User::class)->create(['email' => 'harry@laravel.test']);
        factory(User::class, 190)->create();
    }
}
