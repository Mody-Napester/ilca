<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->integer('company_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('type');
            $table->string('address');
            $table->string('comments');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
