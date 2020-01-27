<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Proxy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Proxy', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip');
            $table->string('port');
            $table->string('login');
            $table->string('password');
            $table->string('proxy_type');
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
        Schema::dropIfExists('Proxy');
    }
}
