<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BusinessManager extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('BusinessManager', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('acc_name');
            $table->string('bm_token');
            $table->BigInteger('acc_id')->unsigned();
            
            $table->integer('status_id');
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
        Schema::dropIfExists('BusinessManager');
    }
}
