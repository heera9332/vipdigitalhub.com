<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormEntry;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(): View
    {
        $stats = [
            'totalInquiries' => FormEntry::count(),
            'newInquiries' => FormEntry::where('status', 'new')->count(),
            'totalPosts' => Post::posts()->count(),
            'publishedPosts' => Post::posts()->where('status', 'published')->count(),
            'totalProjects' => Project::count(),
            'featuredProjects' => Project::where('featured', true)->count(),
            'totalServices' => Service::count(),
            'publishedServices' => Service::where('status', 'published')->count(),
        ];

        $recentInquiries = FormEntry::latest()->take(6)->get();
        $recentPosts = Post::posts()->latest('updated_at')->take(5)->get();

        return view('admin.dashboard', [
            'stats' => $stats,
            'recentInquiries' => $recentInquiries,
            'recentPosts' => $recentPosts,
        ]);
    }
}
