<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleDemandeFournituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_demande_fournitures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_demande_fourniture');
            $table->foreign('id_demande_fourniture')->references('id')->on('demande_fournitures')->onDelete('cascade');
            $table->string('nom_article');
            $table->unsignedBigInteger('qte_demander');
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
        Schema::dropIfExists('article_demande_fournitures');
    }
}
