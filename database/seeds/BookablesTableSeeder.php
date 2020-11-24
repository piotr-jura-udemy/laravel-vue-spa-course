<?php

use App\User;
use App\Bookable;
use Illuminate\Database\Seeder;

class BookablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Bookable::class, 100)->make()->each(function (Bookable $bookable) {
            $bookable->owner()->associate(User::find(random_int(1, 10)));
            $bookable->save();
        });
    }
}
