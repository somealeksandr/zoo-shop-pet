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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->json('title')->default('{}');
            $table->json('description')->default('{}');
            $table->json('image')->default('{}');
            $table->string('slug');
            $table->unsignedFloat('price');
            $table->unsignedFloat('promotional_price')->nullable();
            $table->boolean('is_promotional')->default(false);
            $table->string('quantity')->default(false);
            $table->unsignedBigInteger('country_id')->index()->nullable();
            $table->unsignedBigInteger('brand_id')->index()->nullable();

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('brand_id')->references('id')->on('brands');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
