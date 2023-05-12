<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleFactureFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_facture_fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('facture_fournisseur_id');
            $table->foreign('facture_fournisseur_id')->references('id')->on('facture_fournisseurs')->onDelete('cascade');
            $table->integer('numero');
            $table->string('article');
            $table->integer('qte');
            $table->integer('prix');
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
        Schema::dropIfExists('article_facture_fournisseurs');
    }
}
