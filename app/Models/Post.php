<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PostType;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;

    protected $attributes = [
        'post_type' => 'post',
    ];

    protected $fillable = [
        'post_type',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category',
        'author',
        'reading_time',
        'status',
        'meta_title',
        'meta_description',
        'published_at',
        'client',
        'year',
        'project_url',
        'technologies',
        'gallery',
        'featured',
        'sort_order',
        'icon',
        'features',
        'cta',
        'short_description',
        'description',
        'full_description',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'reading_time' => 'integer',
            'published_at' => 'datetime',
            'featured' => 'boolean',
            'sort_order' => 'integer',
            'technologies' => 'array',
            'gallery' => 'array',
            'features' => 'array',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getShortDescriptionAttribute(): ?string
    {
        return $this->attributes['excerpt'] ?? null;
    }

    public function setShortDescriptionAttribute(?string $value): void
    {
        $this->attributes['excerpt'] = $value;
    }

    public function getDescriptionAttribute(): ?string
    {
        return $this->attributes['content'] ?? null;
    }

    public function setDescriptionAttribute(?string $value): void
    {
        $this->attributes['content'] = $value;
    }

    public function getFullDescriptionAttribute(): ?string
    {
        return $this->attributes['content'] ?? null;
    }

    public function setFullDescriptionAttribute(?string $value): void
    {
        $this->attributes['content'] = $value;
    }

    /**
     * Scope to published posts.
     *
     * @param  Builder<Post>  $query
     * @return Builder<Post>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope by post type.
     *
     * @param  Builder<Post>  $query
     * @return Builder<Post>
     */
    public function scopeType(Builder $query, PostType|string $type): Builder
    {
        $value = $type instanceof PostType ? $type->value : $type;

        return $query->where('post_type', $value);
    }

    /**
     * Scope to standard blog articles.
     *
     * @param  Builder<Post>  $query
     * @return Builder<Post>
     */
    public function scopePosts(Builder $query): Builder
    {
        return $query->where('post_type', PostType::Post->value);
    }

    /**
     * Scope to portfolio projects.
     *
     * @param  Builder<Post>  $query
     * @return Builder<Post>
     */
    public function scopeProjects(Builder $query): Builder
    {
        return $query->where('post_type', PostType::Project->value);
    }

    /**
     * Scope to service offerings.
     *
     * @param  Builder<Post>  $query
     * @return Builder<Post>
     */
    public function scopeServices(Builder $query): Builder
    {
        return $query->where('post_type', PostType::Service->value);
    }

    /**
     * Scope to featured records.
     *
     * @param  Builder<Post>  $query
     * @return Builder<Post>
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    public function isPost(): bool
    {
        return $this->post_type === PostType::Post->value;
    }

    public function isProject(): bool
    {
        return $this->post_type === PostType::Project->value;
    }

    public function isService(): bool
    {
        return $this->post_type === PostType::Service->value;
    }
}
