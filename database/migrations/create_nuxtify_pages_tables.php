<?php

use Nuxtifyts\NuxtifyPages\Models\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Nuxtifyts\NuxtifyPages\Enums\CategoryRelation;
use Nuxtifyts\NuxtifyPages\Enums\PageStatus;
use Nuxtifyts\NuxtifyPages\Enums\PageVisibility;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $prefix = config('nuxtify-pages.database.prefix', '');

        $prefix = $prefix ? $prefix . '_' : '';

        Schema::create("{$prefix}layouts", function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->json('metadata')->nullable();
            $table->json('content');
            $table->timestamps();
        });

        Schema::create("{$prefix}pages", function (Blueprint $table) {
            $table->id();
            $table->json('slug');
            $table->json('title');
            $table->json('description')->nullable();
            $table->json('content');
            $table->json('metadata')->nullable();
            $table->unsignedBigInteger('layout_id')->nullable();
            $table->enum('status', array_column(PageStatus::cases(), 'value'))->default(PageStatus::DRAFT);
            $table->enum('visibility', array_column(PageVisibility::cases(), 'value'))->default(PageVisibility::PUBLIC);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->foreign('layout_id')->references('id')->on('layouts')->nullOnDelete();
        });

        Schema::create("{$prefix}tags", function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create("{$prefix}taggables", function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('taggable_id');
            $table->enum('taggable_type', [
                addslashes(Page::class),
            ]);
            $table->timestamps();
        });

        Schema::create("{$prefix}categories", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->json('metadata')->nullable();
            $table->json('name');
            $table->json('description')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('categories')->cascadeOnDelete();
        });

        Schema::create("{$prefix}related_categories", function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('related_category_id')->constrained('categories')->cascadeOnDelete();
            $table->enum('relation', array_column(CategoryRelation::cases(), 'value'))->default(CategoryRelation::RELATED);

            $table->unique(['category_id', 'related_category_id']);
        });

        Schema::create("{$prefix}category_pages", function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();

            $table->unique(['category_id', 'page_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('related_categories');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('taggables');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('components');
        Schema::dropIfExists('images');
        Schema::dropIfExists('paragraphs');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('layouts');
    }
};
