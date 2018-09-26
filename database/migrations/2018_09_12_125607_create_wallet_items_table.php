<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wallet_id')->unsigned()->index();
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
            $table->string('name');
            $table->string('balance')->default(0);
            $table->string('manage')->default('manage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_items');
    }
}
