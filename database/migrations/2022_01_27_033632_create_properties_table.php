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
            $table->string('landlord_first_name')->nullable();
            $table->string('landlord_last_name')->nullable();
            $table->string('primary_mobile')->nullable();
            $table->string('secondary_mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('address', 255)->nullable();
            $table->timestamp('registered_at')->nullable();
            $table->unsignedTinyInteger('deed')->default(1);//نوع سند
            $table->unsignedTinyInteger('usage')->default(1);//نوع کاربری
            $table->boolean('for_rent')->default(1);
            $table->boolean('for_sell')->default(0);
            $table->boolean('for_pre_sell')->default(0);
            $table->unsignedTinyInteger('status')->default(1);
            $table->boolean('parking')->default(0);
            $table->boolean('storage')->default(0);
            $table->boolean('asansor')->default(0);
            $table->unsignedTinyInteger('share')->default(6);
            $table->unsignedTinyInteger('floor')->default(0);
            $table->unsignedTinyInteger('total_floor')->nullable();
            $table->unsignedTinyInteger('unit')->nullable();
            $table->unsignedTinyInteger('total_unit')->nullable();
            $table->unsignedInteger('total_area')->nullable();
            $table->unsignedInteger('built_area')->nullable();
            $table->unsignedSmallInteger('age')->nullable();
            $table->boolean('elevator')->default(0);
            $table->boolean('balcony')->default(0);
            $table->boolean('yard')->default(0);
            $table->unsignedTinyInteger('total_rooms')->default(0);;
            $table->boolean('toilet_together')->default(0);
            $table->string('texture')->nullable();
            $table->integer('state_id')->unsigned();
            $table->integer('city_id')->unsigned();
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
        Schema::dropIfExists('properties');
    }
}
