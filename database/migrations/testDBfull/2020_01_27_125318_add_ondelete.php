<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOndelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Accounts', function($table) {
          $table->dropForeign(['acc_owner']);
          $table->dropForeign(['acc_proxy_id']);   
          $table->foreign('acc_owner')->references('id')->on('Owner')->onDelete('cascade');
          $table->foreign('acc_proxy_id')->references('id')->on('Proxy')->onDelete('cascade');
        });

        Schema::table('BusinessManager', function($table) {
          $table->dropForeign(['acc_id']);
          $table->foreign('acc_id')->references('id')->on('Accounts')->onDelete('cascade');
          
        });

        Schema::table('ACT', function($table) {
          $table->dropForeign(['bm_id']);
          $table->foreign('bm_id')->references('id')->on('BusinessManager')->onDelete('cascade');
          
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
