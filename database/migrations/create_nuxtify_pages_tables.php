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
    private ?string $prefix = null;

    private function getPrefix(): string
    {
        return $this->prefix ??= (
        ($prefix = config('nuxtify-pages.database.prefix', ''))
            ? $prefix . '_'
            : ''
        );
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("{$this->getPrefix()}pages", function (Blueprint $table) {
            $table->id();
            $table->json('slug');
            $table->json('title');
            $table->json('description')->nullable();
            $table->json('cover_image')->nullable();
            $table->json('content');
            $table->json('metadata')->nullable();
            $table->enum('status', array_column(PageStatus::cases(), 'value'))->default(PageStatus::DRAFT);
            $table->enum('visibility', array_column(PageVisibility::cases(), 'value'))->default(PageVisibility::PUBLIC);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create("{$this->getPrefix()}tags", function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create("{$this->getPrefix()}taggables", function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')
                ->constrained(table: "{$this->getPrefix()}tags")
                ->cascadeOnDelete();
            $table->unsignedBigInteger('taggable_id');
            $table->enum('taggable_type', [
                addslashes(Page::class),
            ]);
            $table->timestamps();
        });

        Schema::create("{$this->getPrefix()}categories", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->json('metadata')->nullable();
            $table->json('name');
            $table->json('description')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on(table: "{$this->getPrefix()}categories")
                ->cascadeOnDelete();
        });

        Schema::create("{$this->getPrefix()}related_categories", function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained(table: "{$this->getPrefix()}categories")
                ->cascadeOnDelete();
            $table->foreignId('related_category_id')
                ->constrained(table: "{$this->getPrefix()}categories")
                ->cascadeOnDelete();
            $table->enum('relation', array_column(CategoryRelation::cases(), 'value'))->default(CategoryRelation::RELATED);

            $table->unique(['category_id', 'related_category_id'], 'category_id_related_category_id_unique');
        });

        Schema::create("{$this->getPrefix()}category_pages", function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained(table: "{$this->getPrefix()}categories")
                ->cascadeOnDelete();
            $table->foreignId('page_id')
                ->constrained(table: "{$this->getPrefix()}pages")
                ->cascadeOnDelete();

            $table->unique(['category_id', 'page_id'], 'category_id_page_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->getPrefix() . 'category_pages');
        Schema::dropIfExists($this->getPrefix() . 'related_categories');
        Schema::dropIfExists($this->getPrefix() . 'categories');
        Schema::dropIfExists($this->getPrefix() . 'taggables');
        Schema::dropIfExists($this->getPrefix() . 'tags');
        Schema::dropIfExists($this->getPrefix() . 'components');
        Schema::dropIfExists($this->getPrefix() . 'images');
        Schema::dropIfExists($this->getPrefix() . 'paragraphs');
        Schema::dropIfExists($this->getPrefix() . 'pages');
    }
};
