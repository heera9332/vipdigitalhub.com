<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class AboutController extends Controller
{
    /**
     * Display the about us page.
     */
    public function index(): View
    {
        return view('pages.about');
    }
}
