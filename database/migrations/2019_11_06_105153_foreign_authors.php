<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignAuthors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ForeignAuthors', function (Blueprint $table) {
            $table->Increments('id');
            $table->String('name');
            $table->integer('books')->unsigned();
            $table->foreign('books')->references('id')->on('ForeignBooks');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ForeignAuthors');
    }
}
