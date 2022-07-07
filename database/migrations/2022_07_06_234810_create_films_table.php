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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('poster_image')->nullable();
            $table->string('preview_image')->nullable();
            $table->string('background_image')->nullable();
            $table->string('background_color')->default('#ffffff');
            $table->string('video_link');
            $table->string('preview_video_link')->nullable();
            $table->text('description');
            $table->float('rating')->nullable();
            $table->integer('scores_count')->default(0);
            $table->string('director');
            $table->text('starring')->nullable();
            $table->integer('run_time');
            $table->string('genre')->nullable();
            $table->year('released');
            $table->string('imdb')->unique();
            $table->softDeletes('deleted_at');
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
        Schema::dropIfExists('films');
    }
};
