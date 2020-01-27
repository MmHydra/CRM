<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ACT extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ACT', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('act_id');
            $table->string('status_id');
            $table->BigInteger('bm_id')->unsigned();
            
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
   });

}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ACT');
    }
}
