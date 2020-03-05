<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CancelOnDeleteOwnersProxy extends Migration
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
              $table->foreign('acc_owner')->references('id')->on('Owner');
              $table->foreign('acc_proxy_id')->references('id')->on('Proxy');
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
