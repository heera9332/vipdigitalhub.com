<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects with optional category filter.
     */
    public function index(Request $request): View
    {
        $selectedCategory = $request->query('category');

        $categories = Project::published()
            ->distinct()
            ->pluck('category')
            ->filter()
            ->values();

        $projects = Project::published()
            ->when($selectedCategory, fn ($query) => $query->where('category', $selectedCategory))
            ->orderBy('sort_order')
            ->latest('published_at')
            ->paginate(6)
            ->withQueryString();

        return view('pages.projects', [
            'projects' => $projects,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
        ]);
    }

    /**
     * Display a single project case study.
     */
    public function show(Project $project): View
    {
        abort_unless($project->status === 'published' && $project->published_at?->isPast(), 404);

        $relatedProjects = Project::published()
            ->where('id', '!=', $project->id)
            ->where('category', $project->category)
            ->take(3)
            ->get();

        if ($relatedProjects->count() < 2) {
            $relatedProjects = Project::published()
                ->where('id', '!=', $project->id)
                ->take(3)
                ->get();
        }

        return view('pages.projects.show', [
            'project' => $project,
            'relatedProjects' => $relatedProjects,
        ]);
    }
}
