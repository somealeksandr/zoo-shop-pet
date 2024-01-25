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
        Schema::create('subcategory_animals', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description');
            $table->string('slug');
            $table->unsignedBigInteger('category_animal_id')->index();

            $table->foreign('category_animal_id')->references('id')->on('category_animals');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategory_animals');
    }
};
