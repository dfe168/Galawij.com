<?php

namespace App\Http\Controllers;

use App\Actions\StoreImageFileAction;
use App\Http\Requests\StorePaintingRequest;
use App\Http\Requests\UpdatePaintingRequest;
use App\Models\Paintings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PaintingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paintings = Paintings::when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })
            ->with('user')
            ->orderBy('id', 'desc')->paginate(9)
            ->withQueryString();

        return Inertia::render('Dashboard/Home', [
            'paintings' => $paintings,
            'searchTerm' => $request->search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StorePaintingRequest $request, StoreImageFileAction $storeImageFileAction): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('img')) {
            $imgName = $storeImageFileAction->handle($validated['img']);
        }

        $validated['img'] = $imgName;
        $validated['user_id'] = Auth::id();

        Paintings::create($validated);

        return redirect()->route('dashboard.home')
            ->with('success', "{$validated['name']} Painting created");
    }

    public function update(UpdatePaintingRequest $request, int $id, StoreImageFileAction $storeImageFileAction): RedirectResponse
    {

        $validated = $request->validated();

        $painting = Paintings::findOrFail($id);

        if ($request->hasFile('img')) {
            $imgName = $storeImageFileAction->handle($validated['img']);
        }

        $validated['img'] = ($request->hasFile('img')) ? $imgName : $painting->img;
        $validated['user_id'] = Auth::id();

        $painting->update($validated);

        return redirect()
            ->route('dashboard.home')
            ->with('success', 'Painting updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): void
    {
        Paintings::destroy($id);
    }
}
