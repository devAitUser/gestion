<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriqueStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historique_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('nom_article');
            $table->string('type');
            $table->unsignedBigInteger('qte');
            $table->unsignedBigInteger('prix');
            $table->unsignedBigInteger('id_projet');
            $table->foreign('id_projet')->references('id')->on('projets')->onDelete('cascade');
            $table->date('date');
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
        Schema::dropIfExists('historique_stocks');
    }
}
