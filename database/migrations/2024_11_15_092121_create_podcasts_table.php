<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('podcasts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('audio');
            $table->string('image')->nullable();
            $table->unsignedInteger('duration', autoIncrement: false);
            $table->string('category_id');
            $table->string('podcaster_id');
            $table->timestamps();

            $table->foreignId('category_id')->on('categories')->onDelete('cascade');
            $table->foreignId('podcaster_id')->on('podcasters')->onDelete('cascade');
            // $table->foreign('category_id')
            //     ->references('id')
            //     ->on('categories')
            //     ->onUpdate('cascade');

            // $table->foreign('podcaster_id')
            //     ->references('id')
            //     ->on('podcasters')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('podcasts');
    }
};
