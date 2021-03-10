<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('gender');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('street');
            $table->string('city');
            $table->string('country');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('yearofbirth')->nullable();

            $table->index(['name']);
            $table->index(['gender']);
            $table->index(['firstname']);
            $table->index(['lastname']);
            $table->index(['city']);
            $table->index(['country']);
            $table->index(['email']);
            $table->index(['phone']);
            $table->index(['yearofbirth']);

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
        Schema::dropIfExists('teams');
    }
}
