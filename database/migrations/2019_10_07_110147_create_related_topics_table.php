<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatedTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('related_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("article_id")->nullable();
            $table->foreign("article_id")
                  ->references("id")
                  ->on("articles");
            $table->unsignedInteger("related_id")->nullable();
            $table->foreign("related_id")
                ->references("id")
                ->on("articles");
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
        Schema::dropIfExists('related_topics');
    }
}
