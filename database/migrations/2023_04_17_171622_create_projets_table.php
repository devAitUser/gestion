<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('client');
            $table->string('type_prestation');
            $table->string('objet');
            $table->unsignedBigInteger('n_marche');
            $table->dateTime('date_debut');
            $table->string('duree');
            $table->unsignedBigInteger('montant_min');
            $table->unsignedBigInteger('montant_max');
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
        Schema::dropIfExists('projets');
    }
}
