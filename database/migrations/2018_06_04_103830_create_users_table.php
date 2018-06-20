<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pseudo', 254);
            $table->string('password',254);
            $table->string('nom');
            $table->string('prenom');
            $table->string('sexe');
            $table->string('email', 254)->nullable();
            $table->string('ville');
            $table->integer('codePostal');
            $table->string('adresse');
            $table->string('canton');
            $table->integer('telephone');
            $table->integer('telephone_2')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('users');
    }
}
