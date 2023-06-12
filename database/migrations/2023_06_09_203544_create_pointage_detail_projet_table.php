<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointageDetailProjetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pointage_detail_projets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('projet_id');
            $table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade');
            $table->string('nom_prenom');
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
        Schema::dropIfExists('pointage_detail_projet');
    }
}
