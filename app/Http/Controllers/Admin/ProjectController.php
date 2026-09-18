<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectRequest;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects.
     */
    public function index(Request $request): View
    {
        $query = Project::query();

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search): void {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('client', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $projects = $query->latest('sort_order')->latest('updated_at')->paginate(15)->withQueryString();
        $categories = Project::distinct()->pluck('category')->filter()->values();

        return view('admin.projects.index', [
            'projects' => $projects,
            'categories' => $categories,
            'search' => $search,
            'selectedCategory' => $category,
            'status' => $status,
        ]);
    }

    /**
     * Show the form for creating a new project.
     */
    public function create(): View
    {
        $categories = Project::distinct()->pluck('category')->filter()->values();

        return view('admin.projects.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(ProjectRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $counter = 1;
            while (Project::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }
            $validated['slug'] = $slug;
        }

        $validated['featured'] = $request->boolean('featured');

        if (! empty($validated['technologies'])) {
            $validated['technologies'] = array_values(array_filter(array_map('trim', explode(',', $validated['technologies']))));
        } else {
            $validated['technologies'] = [];
        }

        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        Project::create($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Case study project created successfully.');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project): View
    {
        $categories = Project::distinct()->pluck('category')->filter()->values();

        return view('admin.projects.edit', [
            'project' => $project,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified project in storage.
     */
    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['featured'] = $request->boolean('featured');

        if (! empty($validated['technologies'])) {
            $validated['technologies'] = array_values(array_filter(array_map('trim', explode(',', $validated['technologies']))));
        } else {
            $validated['technologies'] = [];
        }

        if ($validated['status'] === 'published' && empty($project->published_at)) {
            $validated['published_at'] = now();
        }

        $project->update($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Case study project updated successfully.');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Case study project deleted successfully.');
    }
}
