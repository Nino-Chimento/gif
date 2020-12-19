<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeywordGifproviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keyword_gifprovider', function (Blueprint $table) {
            $table->unsignedBigInteger('keyword_id');
            $table->foreign('keyword_id')->references('id')->on('keywords');
            $table->unsignedBigInteger('gifprovider_id');
            $table->foreign('gifprovider_id')->references('id')->on('gifproviders');
            $table->integer("counts_calls");
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
        Schema::dropIfExists('keyword_gifprovider');
    }
}
