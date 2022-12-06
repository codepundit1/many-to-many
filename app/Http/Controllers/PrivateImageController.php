<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use App\Models\PrivateImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrivateImageController extends Controller
{

    public function index()
    {
        $privateImages = PrivateImage::latest()->paginate();
        return view('private-images.index', compact('privateImages'));
    }


    public function create()
    {
        return view('private-images.create');
    }


    public function store(Request $request)
    {
        $valid = $request->validate([
            'image' => ['image', 'required', 'max:2048'],
        ]);

        if ($request->hasFile('image'))
            $valid['image'] = $request->file('image')->store('PrivateImage');

        if (PrivateImage::create($valid))
            return redirect()->route('private-images.index')->with('message', 'Image created successfully');
    }

    public function edit(PrivateImage $privateImage)
    {
        return view('private-images.edit', compact('privateImage'));
    }


    public function update(Request $request, PrivateImage $privateImage)
    {
        $valid = $request->validate([
            'image' => ['image', 'nullable', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            if (Storage::exists($privateImage->image))
                Storage::delete($privateImage->image);
            $valid['image'] = $request->file('image')->store('PrivateImage');
        } else
            $valid = Arr::except($valid, 'image');

        if ($privateImage->update($valid))
            return redirect()->route('private-images.index')->with('message', 'Image Updated successfully');
    }


    public function destroy(PrivateImage $privateImage)
    {
        if (Storage::exists($privateImage->image))
            Storage::delete($privateImage->image);
        if ($privateImage->delete())
            return redirect()->back()->with('message', 'Image Deleted successfully');
    }


    public function privateImage(PrivateImage $privateImage)
    {
        return response()->file(Storage::path($privateImage->image));
    }
}
