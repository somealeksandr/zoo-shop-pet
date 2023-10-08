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
        Schema::create('animal_subscriber', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('animal_id')->index();
            $table->unsignedBigInteger('subscriber_id')->index();

            $table->foreign('animal_id')->references('id')->on('animals');
            $table->foreign('subscriber_id')->references('id')->on('subscribers');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal_subscriber');
    }
};
