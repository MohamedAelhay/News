<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string("main_title", 150);
            $table->string("second_title", 150)->nullable();
            $table->string("content");
            $table->enum("type", ["article", "news"]);
            $table->boolean('is_publish')->default(true);
            $table->unsignedInteger("user_id")->nullable();
            $table->foreign("user_id")
                  ->references("id")
                  ->on("users");
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
        Schema::dropIfExists('articles');
    }
}
