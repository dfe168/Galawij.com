<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaintingRequest;
use App\Http\Requests\UpdatePaintingRequest;
use App\Models\Paintings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaintingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $paintings = Paintings::query()->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })->orderBy('id', 'desc')->paginate(9)->withQueryString();

        return $paintings;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StorePaintingRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('img')) {
            $imgName = uniqid() . "." . $validated['img']->getClientOriginalExtension();

            Storage::disk('public')
                ->putFileAs('paintings', $request->file('img'), $imgName); //img toevoegen
        }

        $validated['img'] = $imgName;

        Paintings::create($validated);

        return redirect()->route('dashboard.home')
            ->with('success', "{$validated['name']} Painting created");
    }

    public function update(UpdatePaintingRequest $request, int $id)
    {

        $validated = $request->validated();

        $painting = Paintings::findOrFail($id);

        if ($request->hasFile('img')) {
            $imgName = uniqid() . "." . $validated['img']->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('paintings', $validated['img'], $imgName); //img toevoegen
        }

        $validated['img'] = ($request->hasFile('img')) ? $imgName : $painting->img;

        $painting->update($validated);

        return redirect()
            ->route('dashboard.home',)
            ->with('success', 'Painting updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        Paintings::destroy($id);
    }
}
