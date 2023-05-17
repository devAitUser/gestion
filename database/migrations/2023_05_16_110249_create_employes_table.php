<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('adresse');
            $table->date('date_naissance');
            $table->string('ville');
            $table->unsignedBigInteger('cnss');
            $table->string('cin');
            $table->unsignedBigInteger('telephone');
            $table->string('email');
            $table->string('genre');
            $table->string('nationnalite');
            $table->string('fonction');
            $table->date('date_recrutement');
            $table->string('banque');
            $table->date('debut_contrat');
            $table->date('fin_contrat');
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
        Schema::dropIfExists('employes');
    }
}
