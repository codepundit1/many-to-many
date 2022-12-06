<?php

namespace App\Http\Controllers;

use App\Models\PublicImage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class PublicImageController extends Controller
{

    public function index()
    {
        $publicImages = PublicImage::latest()->paginate();
        return view('public-images.index', compact('publicImages'));
    }


    public function create()
    {
        return view('public-images.create');
    }


    public function store(Request $request)
    {
        $valid = $request->validate([
            'image' => ['image', 'required', 'max:2048'],
        ]);

        if ($request->hasFile('image'))
            $valid['image'] = $request->file('image')->store('PublicImage', 'public');

        if (PublicImage::create($valid))
            return redirect()->route('public-images.index')->with('message', 'Image created successfully');
    }


    public function edit(PublicImage $publicImage)
    {
        return view('public-images.edit', compact('publicImage'));
    }


    public function update(Request $request, PublicImage $publicImage)
    {
        $valid = $request->validate([
            'image' => ['image', 'nullable', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($publicImage->getRawOriginal('image')))
                Storage::disk('public')->delete($publicImage->getRawOriginal('image'));
            $valid['image'] = $request->file('image')->store('PublicImage', 'public');
        } else
            $valid = Arr::except($valid, 'image');

        if ($publicImage->update($valid))
            return redirect()->route('public-images.index')->with('message', 'Image Updated successfully');
    }

    public function destroy(PublicImage $publicImage)
    {
        if (Storage::disk('public')->exists($publicImage->getRawOriginal('image')))
            Storage::disk('public')->delete($publicImage->getRawOriginal('image'));
        if ($publicImage->delete())
            return redirect()->back()->with('message', 'Image Deleted successfully');
    }
}
