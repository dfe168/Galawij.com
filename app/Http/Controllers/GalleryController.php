<?php

namespace App\Http\Controllers;

use App\Models\Paintings;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GalleryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render("Gallery", [
            'paintings' => Paintings::orderBy('id', 'DESC')->paginate(9),
        ]);
    }
}
