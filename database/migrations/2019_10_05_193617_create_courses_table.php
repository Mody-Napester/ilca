<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->string('title');
            $table->text('details');
            $table->string('location_id');
            $table->float('price_egp')->nullable();
            $table->float('price_usd')->nullable();
            $table->string('date_from');
            $table->string('date_to');
            $table->boolean('is_active')->default(1);
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
