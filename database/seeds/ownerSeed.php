<?php

use Illuminate\Database\Seeder;

class ownerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Owner')->insert([
                                    ['name' => 'Andrey'],
                                    ['name' => 'Maxim'],
                                    ['name' => 'Julia']
                                ]);
    }
}
