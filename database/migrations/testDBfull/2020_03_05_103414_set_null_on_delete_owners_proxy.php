<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetNullOnDeleteOwnersProxy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Accounts', function($table) {

              //$table->dropForeign(['acc_proxy_id']);   
             //$table->dropForeign('Accounts_acc_proxy_id_foreign');   

              $table->foreign('acc_proxy_id')->references('id')->on('Proxy')->onDelete('set null');
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
