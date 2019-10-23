<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventVisitorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_visitor', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("event_id")->nullable();
            $table->foreign("event_id")
                ->references("id")
                ->on("events");
            $table->unsignedInteger("visitor_id")->nullable();
            $table->foreign("visitor_id")
                ->references("id")
                ->on("visitors");
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
        Schema::dropIfExists('event_visitor');
    }
}
