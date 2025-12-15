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
                Schema::create('page_layouts', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('page_id')->index();

                // section info
                $table->string('type');       
                // slider | carousel | grid | banner | logos

                $table->string('section_id')->nullable(); 
                // grid1, banner2, slider_main (for grouping)

                $table->string('title')->nullable();
                $table->text('description')->nullable();

                // 🔥 MOST IMPORTANT
                $table->json('data')->nullable(); 
                // images, text, buttons, urls, columns etc.

                $table->integer('sort_order')->default(0);
                $table->boolean('status')->default(1);

                $table->timestamps();

                $table->foreign('page_id')
                    ->references('id')
                    ->on('pages')
                    ->onDelete('cascade');
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_layouts');
    }
};
