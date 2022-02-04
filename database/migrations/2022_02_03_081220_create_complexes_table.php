<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complexes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('manager')->nullable();
            $table->string('primary_mobile')->nullable();
            $table->string('secondary_mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('address', 255)->nullable();
            $table->unsignedTinyInteger('total_block')->nullable();
            $table->unsignedTinyInteger('total_unit')->nullable();
            $table->string('description', 255)->nullable();
            $table->bigInteger('state_id')->unsigned()->nullable();
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->bigInteger('area_id')->unsigned()->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('state_id', 'fk_complexes_states')
            ->references('id')
            ->on('states')
            ->onUpdate('CASCADE')
            ->onDelete('NO ACTION');

            $table->foreign('city_id', 'fk_complexes_cities')
            ->references('id')
            ->on('cities')
            ->onUpdate('CASCADE')
            ->onDelete('NO ACTION');

            $table->foreign('area_id', 'fk_complexes_areas')
            ->references('id')
            ->on('areas')
            ->onUpdate('CASCADE')
            ->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complexes');
    }
}
