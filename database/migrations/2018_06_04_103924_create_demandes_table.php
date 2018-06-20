<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('junior_id')->nullable();
            $table->integer('senior_id');
            $table->integer('employe_id')->nullable();
            $table->foreign('senior_id')->references('id')->on('seniors');
            $table->foreign('employe_id')->references('id')->on('employes');
            $table->text('description');
            $table->date('date');
            $table->time('heure');
            $table->integer('duree');
            $table->string('titre');
            $table->string('statut');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demandes');
    }
}
