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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->json('title')->default('{}');
            $table->json('description')->default('{}');
            $table->json('icon')->default('{}');
            $table->string('slug');
            $table->unsignedBigInteger('animal_id')->nullable();

            $table->foreign('animal_id')->references('id')->on('animals');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
