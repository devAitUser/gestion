<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoPointagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_pointages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pointage_detail_id');
            $table->foreign('pointage_detail_id')->references('id')->on('pointage_details')->onDelete('cascade');
            $table->string('nom_employe');
            $table->string('jour_travaille');
            $table->string('avance_salaire');
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
        Schema::dropIfExists('info_pointages');
    }
}
