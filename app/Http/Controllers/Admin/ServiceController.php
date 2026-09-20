<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index(Request $request): View
    {
        $query = Service::query();

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search): void {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $services = $query->orderBy('sort_order')->latest('updated_at')->paginate(15)->withQueryString();

        return view('admin.services.index', [
            'services' => $services,
            'search' => $search,
            'status' => $status,
        ]);
    }

    /**
     * Show the form for creating a new service.
     */
    public function create(): View
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(ServiceRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $counter = 1;
            while (Post::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }
            $validated['slug'] = $slug;
        }

        if (! empty($validated['features'])) {
            if (is_string($validated['features'])) {
                $features = preg_split('/[\r\n,]+/', $validated['features']);
                $validated['features'] = array_values(array_filter(array_map('trim', $features ?? [])));
            }
        } else {
            $validated['features'] = [];
        }

        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $validated['category'] = $validated['category'] ?? 'Technology Services';
        $validated['author'] = 'VIP Digital Hub';

        Service::create($validated);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service offering created successfully.');
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service): View
    {
        return view('admin.services.edit', [
            'service' => $service,
        ]);
    }

    /**
     * Update the specified service in storage.
     */
    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if (! empty($validated['features'])) {
            if (is_string($validated['features'])) {
                $features = preg_split('/[\r\n,]+/', $validated['features']);
                $validated['features'] = array_values(array_filter(array_map('trim', $features ?? [])));
            }
        } else {
            $validated['features'] = [];
        }

        if ($validated['status'] === 'published' && empty($service->published_at)) {
            $validated['published_at'] = now();
        }

        $service->update($validated);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service offering updated successfully.');
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service offering deleted successfully.');
    }
}
