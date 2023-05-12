<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriquePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historique_paiements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facture_fournisseur_id');
            $table->foreign('facture_fournisseur_id')->references('id')->on('facture_fournisseurs')->onDelete('cascade');
            $table->string('mode_paiement');
            $table->string('n_cheque')->nullable();
            $table->date('date_cheque')->nullable();
            $table->integer('montant');
            $table->string('etat_paiement');
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
        Schema::dropIfExists('historique_paiements');
    }
}
