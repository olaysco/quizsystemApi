<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_question', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->index();
            $table->integer('question_id')->index();
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('question_id')
                ->references('id')->on('questions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category__questions');
    }
}
