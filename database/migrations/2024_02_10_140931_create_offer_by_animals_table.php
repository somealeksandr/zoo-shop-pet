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
        Schema::create('offer_by_animals', function (Blueprint $table) {
            $table->id();
            $table->json('offer_text');
            $table->json('offer_type');
            $table->json('image');
            $table->unsignedBigInteger('animal_id');

            $table->foreign('animal_id')->references('id')->on('animals');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_by_animals');
    }
};
