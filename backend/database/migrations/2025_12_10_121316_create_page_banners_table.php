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
        Schema::create('page_banners', function (Blueprint $table) {
          $table->id();

                $table->unsignedBigInteger('page_id');   // relation with pages table

                $table->string('bg_image')->nullable();       // background image
                $table->string('image')->nullable();          // main image
                $table->string('text_img')->nullable();       // text image

                $table->string('title')->nullable();
                $table->string('subtitle')->nullable();

                $table->string('button1_text')->nullable();
                $table->string('button1_link')->nullable();

                $table->string('button2_text')->nullable();
                $table->string('button2_link')->nullable();

                $table->integer('sort_order')->default(1);

                $table->timestamps();

                // Relationship constraint
                $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_banners');
    }
};
