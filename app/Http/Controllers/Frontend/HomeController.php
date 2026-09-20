<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Display the agency home page.
     */
    public function index(): View
    {
        $featuredProjects = Project::published()
            ->featured()
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        if ($featuredProjects->isEmpty()) {
            $featuredProjects = Project::published()
                ->orderBy('sort_order')
                ->take(3)
                ->get();
        }

        $latestPosts = Post::posts()
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $services = Post::services()
            ->published()
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        if ($services->isEmpty()) {
            $services = array_slice(config('services.offerings', []), 0, 6, true);
        }

        return view('pages.home', [
            'featuredProjects' => $featuredProjects,
            'latestPosts' => $latestPosts,
            'services' => $services,
        ]);
    }
}
