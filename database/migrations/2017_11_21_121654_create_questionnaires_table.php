<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->integer('isAccepting')->default(0);
            $table->integer('ordinance_id')->unsigned()->nullable();
            $table->foreign('ordinance_id')->references('id')->on('ordinances');
            $table->integer('resolution_id')->unsigned()->nullable();
            $table->foreign('resolution_id')->references('id')->on('resolutions');
            $table->softDeletes();
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
        Schema::dropIfExists('questionnaires');
    }
}
