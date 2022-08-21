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
            $table->string('video_link')->nullable();
            $table->string('preview_video_link')->nullable();
            $table->text('description')->nullable();
            $table->decimal('rating', $precision = 3, $scale = 1)->nullable();
            $table->integer('scores_count')->default(0);
            $table->integer('run_time')->nullable();
            $table->year('released')->nullable();
            $table->string('imdb_id')->unique();
            $table->set('status', ['pending', 'on moderation', 'ready']);
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
