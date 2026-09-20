<?php

declare(strict_types=1);

namespace App\Enums;

enum PostType: string
{
    case Post = 'post';
    case Project = 'project';
    case Service = 'service';

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return [
            self::Post->value => 'Blog Post',
            self::Project->value => 'Project / Case Study',
            self::Service->value => 'Service Offering',
        ];
    }
}
