<?php

use Illuminate\Database\Seeder;
use Core\Person\Person;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Person::class, 23)->create();
    }
}
