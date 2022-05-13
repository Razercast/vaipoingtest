<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('salary');
            $table->integer('defaultdays');
            $table->integer('workdays');
            $table->boolean('hasvichet');
            $table->boolean('isretired');
            $table->integer('month');
            $table->integer('year');
            $table->integer('invalid');
            $table->double('itog');
            $table->timestamps(); //Думаю можно будет оставить добавив обработку ну не знаю в общем
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_infos');
    }
}
