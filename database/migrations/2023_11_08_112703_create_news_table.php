<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('content');
            $table->json('image');
            $table->string('slug');
            $table->unsignedBigInteger('reading_time_minutes')->default(1);
            $table->unsignedBigInteger('category_id')->index();
            $table->timestamp('published_at')->nullable();

            $table->foreign('category_id')->references('id')->on('news_categories');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
