<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AuthorBooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ForeignBooks')->insert(['name' => 'str_random(10)',
    										'test_column'=> 1,]);
    }
}
