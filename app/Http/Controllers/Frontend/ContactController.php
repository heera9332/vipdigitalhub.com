<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\FormEntry;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index(Request $request): View
    {
        $services = Post::services()
            ->published()
            ->orderBy('sort_order')
            ->get();

        if ($services->isEmpty()) {
            $services = config('services.offerings', []);
        }

        $selectedService = $request->query('service');

        return view('pages.contact', [
            'services' => $services,
            'selectedService' => $selectedService,
        ]);
    }

    /**
     * Handle the contact form submission.
     */
    public function submit(ContactRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        FormEntry::create([
            'form_name' => 'contact',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'company' => $validated['company'] ?? null,
            'service' => $validated['service'] ?? null,
            'budget' => $validated['budget'] ?? null,
            'message' => $validated['message'],
            'status' => 'new',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()
            ->route('contact')
            ->with('success', 'Thank you! Your project inquiry has been received. Our team will review your requirements and get back to you within 24 hours.');
    }
}
