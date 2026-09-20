<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\View\View;

class ServiceController extends Controller
{
    /**
     * Display the services catalog.
     */
    public function index(): View
    {
        $services = Post::services()
            ->published()
            ->orderBy('sort_order')
            ->latest('published_at')
            ->get();

        if ($services->isEmpty()) {
            $services = config('services.offerings', []);
        }

        return view('pages.services', [
            'services' => $services,
        ]);
    }
}
