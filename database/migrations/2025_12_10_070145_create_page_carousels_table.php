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
        Schema::create('page_carousels', function (Blueprint $table) {
             $table->id();
             $table->unsignedBigInteger('page_id');

            // Carousel Settings (apply to whole page)
            $table->integer('items_desktop')->default(3);
            $table->integer('items_tablet')->default(2);
            $table->integer('items_mobile')->default(1);
            $table->boolean('autoplay')->default(1);
            $table->integer('speed')->default(3000);
            $table->boolean('loop')->default(1);
            $table->boolean('nav')->default(1);
            $table->boolean('dots')->default(1);

            // Carousel Item Fields (used only if this row is an item)
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            $table->integer('sort_order')->default(0);

            $table->timestamps();
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_carousels');
    }
};
