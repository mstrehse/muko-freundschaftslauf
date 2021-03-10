<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('team_id');
            $table->string('name');
            $table->string('contact')->nullable();
            $table->string('street');
            $table->string('city');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('infos')->nullable();
            $table->integer('amount')->nullable();

            $table->index(['name']);
            $table->index(['contact']);
            $table->index(['street']);
            $table->index(['email']);
            $table->index(['phone']);
            $table->index(['amount']);

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
        Schema::dropIfExists('sponsors');
    }
}
