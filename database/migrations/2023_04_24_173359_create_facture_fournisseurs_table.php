<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fournisseurs_id');
            $table->foreign('fournisseurs_id')->references('id')->on('fournisseurs')->onDelete('cascade');
            $table->string('etat_paiement');
            $table->unsignedBigInteger('numero_facture');
            $table->date('date');
            $table->unsignedBigInteger('projet_id')->nullable();
            $table->unsignedBigInteger('total_ttc')->nullable();
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
        Schema::dropIfExists('facture_fournisseurs');
    }
}
