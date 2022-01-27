<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specifications', function (Blueprint $table) {
            $table->id();
            $table->integer('property_id')->unsigned();
            $table->decimal('total_price', 11, 0)->nullable();
            $table->decimal('unit_price', 11, 0)->nullable();
            $table->decimal('deposit', 11, 0)->nullable();
            $table->decimal('rent', 11, 0)->nullable();
            $table->boolean('sold')->default(0);
            $table->boolean('rented')->default(0);
            $table->boolean('cabinet')->default(0);
            $table->string('cabinet_material')->nullable();
            $table->boolean('parket')->default(0);
            $table->boolean('heating')->default(0);
            $table->string('heating_type')->nullable();
            $table->boolean('cooling')->default(0);
            $table->boolean('telephone')->default(1);
            $table->unsignedTinyInteger('water')->default(1);
            $table->unsignedTinyInteger('electricity')->default(1);
            $table->unsignedTinyInteger('gas')->default(1);
            $table->timestamp('evacuation_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specifications');
    }
}
