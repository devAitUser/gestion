<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleFactureClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_facture_clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('numero');
             $table->unsignedBigInteger('id_facture_clients');
            $table->foreign('id_facture_clients')->references('id')->on('facture_clients')->onDelete('cascade');
            $table->string('article');
            $table->float('quantite');
            $table->float('prix');
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
        Schema::dropIfExists('article_facture_clients');
    }
}
