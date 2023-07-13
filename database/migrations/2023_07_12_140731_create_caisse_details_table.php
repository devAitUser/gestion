<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaisseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caisse_details', function (Blueprint $table) {
            $table->id();
            $table->string('operation');
            $table->string('origin__du_compte')->nullable();
            $table->string('type')->nullable();;
            $table->unsignedBigInteger('id_projet');
            $table->foreign('id_projet')->references('id')->on('projets')->onDelete('cascade');
            $table->string('banque')->nullable();
            $table->date('date');
            $table->unsignedBigInteger('montant');
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
        Schema::dropIfExists('caisse_details');
    }
}
