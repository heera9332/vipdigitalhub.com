<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PostType;
use Database\Factories\ServiceFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Post
{
    /** @use HasFactory<ServiceFactory> */
    use HasFactory;

    protected $table = 'posts';

    protected $attributes = [
        'post_type' => 'service',
        'category' => 'Services',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('service_type', function (Builder $builder): void {
            $builder->where('post_type', PostType::Service->value);
        });

        static::creating(function (Service $service): void {
            $service->post_type = PostType::Service->value;
        });
    }
}
