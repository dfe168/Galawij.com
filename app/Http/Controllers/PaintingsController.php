<?php

namespace App\Http\Controllers;

use App\Models\Paintings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaintingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $paintings = Paintings::paginate(9);

        $paintings = Paintings::query()->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })->orderBy('id', 'desc')->paginate(9)->withQueryString();

        return $paintings;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'img' => ['nullable', 'image', 'max:2048'],
            'name' => ['required', 'string'],
            'medium' => ['required', 'string'],
            'width' => ['required', 'integer', 'max:10000'],
            'length' => ['required', 'integer', 'max:10000'],
        ]);

        if ($request->hasFile('img')) {
            $imgName = $request->file('img')->getClientOriginalName();
            Storage::disk('public')->putFileAs('paintings', $request->file('img'), $imgName); //img toevoegen
        }

        $fields = array_merge($validated, ['img' => $imgName]);

        Paintings::create($fields);
    }

    public function update(Request $request, int $id)
    {

        $validated = $request->validate([
            'img' => ['nullable', 'image', 'max:2048'],
            'name' => ['required', 'string'],
            'medium' => ['required', 'string'],
            'width' => ['required', 'integer', 'max:10000'],
            'length' => ['required', 'integer', 'max:10000'],
        ]);

        $painting = Paintings::findOrFail($id);

        if ($request->hasFile('img')) {
            $imgName = $request->file('img')->getClientOriginalName();
            Storage::disk('public')->putFileAs('paintings', $request->file('img'), $imgName); //img toevoegen
            Storage::disk('public')->delete('paintings/' . $painting->img); //oude img verwijderen
        }

        $painting->update([
            'name' => $validated['name'],
            'medium' => $validated['medium'],
            'width' => $validated['width'],
            'length' => $validated['length'],
            'img' => $request->hasFile('img') ?
                $imgName :
                $painting->img,
        ]);

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
