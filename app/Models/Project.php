<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PostType;
use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Post
{
    /** @use HasFactory<ProjectFactory> */
    use HasFactory;

    protected $table = 'posts';

    protected $attributes = [
        'post_type' => 'project',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('project_type', function (Builder $builder): void {
            $builder->where('post_type', PostType::Project->value);
        });

        static::creating(function (Project $project): void {
            $project->post_type = PostType::Project->value;
        });
    }
}
