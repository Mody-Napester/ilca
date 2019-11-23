<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->integer('client_id');
            $table->integer('project_manger_id');
            $table->integer('activity_status_id');
            $table->string('num_of_words');
            $table->string('num_of_papers');
            $table->string('lang_from');
            $table->string('lang_to');
            $table->string('task_name');
            $table->string('task_type');
            $table->string('rate');
            $table->string('deadline');
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
        Schema::dropIfExists('activities');
    }
}
