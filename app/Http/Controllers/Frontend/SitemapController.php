<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate an XML sitemap for the public website.
     */
    public function index(): Response
    {
        $staticUrls = [
            ['loc' => route('home'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => route('services'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => route('about'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => route('projects'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => route('posts.index'), 'priority' => '0.8', 'changefreq' => 'daily'],
            ['loc' => route('contact'), 'priority' => '0.8', 'changefreq' => 'monthly'],
        ];

        $projects = Project::published()->latest('updated_at')->get();
        $posts = Post::published()->latest('updated_at')->get();

        $content = view('pages.sitemap', [
            'staticUrls' => $staticUrls,
            'projects' => $projects,
            'posts' => $posts,
        ])->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}
