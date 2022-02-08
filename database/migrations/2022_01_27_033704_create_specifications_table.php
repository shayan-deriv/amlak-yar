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
            $table->integer('property_id')->index();
            $table->decimal('total_price', 11, 0)->nullable();
            $table->decimal('unit_price', 11, 0)->nullable();
            $table->decimal('deposit', 11, 0)->nullable();
            $table->decimal('rent', 11, 0)->nullable();
            $table->boolean('sold')->default(0);
            $table->boolean('is_empty')->default(0);
            $table->boolean('rented')->default(0);
            $table->boolean('exchangeable')->default(0); // for sell
            $table->boolean('flexible')->default(0); //for rent
            $table->boolean('cabinet')->default(0);
            $table->boolean('parket')->default(0);
            $table->unsignedTinyInteger('heating')->defalt(0);
            $table->boolean('cooling')->default(0);
            $table->boolean('telephone')->default(1);
            $table->unsignedTinyInteger('water')->default(0);
            $table->unsignedTinyInteger('electricity')->default(0);
            $table->unsignedTinyInteger('gas')->default(0);
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
