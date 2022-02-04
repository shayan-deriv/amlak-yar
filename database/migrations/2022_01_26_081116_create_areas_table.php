<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description', 255)->nullable();
            $table->bigInteger('state_id')->unsigned()->nullable();
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('state_id', 'fk_areas_states')
            ->references('id')
            ->on('states')
            ->onUpdate('CASCADE')
            ->onDelete('NO ACTION');

            $table->foreign('city_id', 'fk_areas_cities')
            ->references('id')
            ->on('cities')
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
        Schema::dropIfExists('areas');
    }
}
