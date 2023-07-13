<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldRibToPointageDetailProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pointage_detail_projets', function (Blueprint $table) {
            $table->unsignedBigInteger('rib')->after('nom_prenom');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pointage_detail_projets', function (Blueprint $table) {
            //
        });
    }
}
