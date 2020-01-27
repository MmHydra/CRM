<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTablesForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
      public function up()
    {
        Schema::table('Accounts', function($table) {
        $table->foreign('acc_owner')->references('id')->on('Owner');
        $table->foreign('acc_proxy_id')->references('id')->on('Proxy');
    });
         Schema::table('BusinessManager', function($table) {
         $table->foreign('acc_id')->references('id')->on('Accounts');
    });
         Schema::table('ACT', function($table) {
         $table->foreign('bm_id')->references('id')->on('BusinessManager');
    });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ForeignBooks', function($table) {
        $table->dropColumn('test_column');
    });
    }
}
