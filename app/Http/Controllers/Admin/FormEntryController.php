<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormEntry;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FormEntryController extends Controller
{
    /**
     * Display a listing of form inquiries.
     */
    public function index(Request $request): View
    {
        $query = FormEntry::query();

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search): void {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%")
                    ->orWhere('service', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $entries = $query->latest()->paginate(15)->withQueryString();

        $statusCounts = [
            'all' => FormEntry::count(),
            'new' => FormEntry::where('status', 'new')->count(),
            'contacted' => FormEntry::where('status', 'contacted')->count(),
            'in_progress' => FormEntry::where('status', 'in_progress')->count(),
            'closed' => FormEntry::where('status', 'closed')->count(),
        ];

        return view('admin.forms.entries.index', [
            'entries' => $entries,
            'search' => $search,
            'status' => $status,
            'statusCounts' => $statusCounts,
        ]);
    }

    /**
     * Display the specified inquiry.
     */
    public function show(FormEntry $entry): View
    {
        return view('admin.forms.entries.show', [
            'entry' => $entry,
        ]);
    }

    /**
     * Update the inquiry status.
     */
    public function updateStatus(Request $request, FormEntry $entry): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['new', 'contacted', 'in_progress', 'closed'])],
        ]);

        $entry->update($validated);

        return back()->with('success', 'Inquiry status updated successfully.');
    }

    /**
     * Remove the specified inquiry.
     */
    public function destroy(FormEntry $entry): RedirectResponse
    {
        $entry->delete();

        return redirect()
            ->route('admin.forms.entries.index')
            ->with('success', 'Inquiry record deleted successfully.');
    }
}
