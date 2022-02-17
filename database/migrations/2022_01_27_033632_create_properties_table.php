<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('type')->default(1);
            $table->string('landlord')->nullable();
            $table->string('primary_mobile')->nullable();
            $table->string('secondary_mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('house_phone')->nullable();
            $table->string('address', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->timestamp('registered_at')->nullable();
            $table->unsignedTinyInteger('deed')->default(1);//نوع سند
            $table->unsignedTinyInteger('usage')->default(1);//نوع کاربری
            $table->boolean('for_rent')->default(1);
            $table->boolean('for_sell')->default(0);
            $table->boolean('for_pre_sell')->default(0);
            $table->unsignedTinyInteger('status')->default(1);
            $table->boolean('parking')->default(0);
            $table->boolean('storage')->default(0);
            $table->boolean('elevator')->default(0);
            $table->boolean('balcony')->default(0);
            $table->boolean('yard')->default(0);
            $table->unsignedTinyInteger('share')->default(6);
            $table->unsignedTinyInteger('floor')->default(0);
            $table->unsignedTinyInteger('total_floor')->nullable();
            $table->unsignedTinyInteger('unit')->nullable();
            $table->unsignedTinyInteger('total_unit')->nullable();
            $table->unsignedInteger('total_area')->nullable();
            $table->unsignedInteger('built_area')->nullable();
            $table->unsignedSmallInteger('age')->nullable();
            $table->unsignedTinyInteger('total_rooms')->default(0);
            $table->boolean('toilet_together')->default(0);
            $table->boolean('for_colleague')->default(0);
            $table->string('texture')->nullable();
            $table->bigInteger('state_id')->unsigned()->nullable();
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->bigInteger('area_id')->unsigned()->nullable();
            $table->bigInteger('complex_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('state_id', 'fk_properties_states')
            ->references('id')
            ->on('states')
            ->onUpdate('CASCADE')
            ->onDelete('NO ACTION');

            $table->foreign('city_id', 'fk_properties_cities')
            ->references('id')
            ->on('cities')
            ->onUpdate('CASCADE')
            ->onDelete('NO ACTION');

            $table->foreign('area_id', 'fk_properties_areas')
            ->references('id')
            ->on('areas')
            ->onUpdate('CASCADE')
            ->onDelete('NO ACTION');

            $table->foreign('complex_id', 'fk_properties_complexes')
            ->references('id')
            ->on('complexes')
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
        Schema::dropIfExists('properties');
    }
}
