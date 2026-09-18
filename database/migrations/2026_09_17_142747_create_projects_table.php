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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description');
            $table->longText('description')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable();
            $table->json('technologies')->nullable();
            $table->string('category')->index();
            $table->string('project_url')->nullable();
            $table->string('client')->nullable();
            $table->string('year', 10)->nullable();
            $table->boolean('featured')->default(false)->index();
            $table->string('status', 20)->default('published')->index();
            $table->integer('sort_order')->default(0)->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
