<?php

namespace App\Http\Controllers;

use App\Models\Bucket;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BucketController extends Controller
{

    public function index()
    {
        $buckets = Bucket::latest()->paginate();
        return view('bucket-images.index', compact('buckets'));
    }


    public function create()
    {
        return view('bucket-images.create');
    }


    public function store(Request $request)
    {
        $valid = $request->validate([
            'image' => ['image', 'required', 'max:2048'],
        ]);

        if ($request->hasFile('image'))
        {
            try
            {
                $valid['image'] = $request->file('image')->storePublicly('s3BucketImage', 's3');
            }
            catch(Exception $exception)
            {
                return back()->with('error', $exception->getMessage());
            }
        }

        if (Bucket::create($valid))
            return redirect()->route('buckets.index')->with('message', 'Image created successfully');
    }


    public function edit(Bucket $bucket)
    {
        return view('bucket-images.edit', compact('bucket'));
    }


    public function update(Request $request, Bucket $bucket)
    {
        $valid = $request->validate([
            'image' => ['image', 'nullable', 'max:2048'],
        ]);

        if ($request->hasFile('image'))
        {
            try
            {
                if (Storage::disk('s3')->exists($bucket->getRawOriginal('image')))
                Storage::disk('s3')->delete($bucket->getRawOriginal('image'));
                $valid['image'] = $request->file('image')->storePublicly('s3BucketImage', 's3');
            }
            catch(Exception $exception)
            {
                return back()->with('error', $exception->getMessage());
            }
        } else
            $valid = Arr::except($valid, 'image');

        if ($bucket->update($valid))
            return redirect()->route('buckets.index')->with('message', 'Image Updated successfully');
    }

    public function destroy(Bucket $bucket)
    {
        if (Storage::disk('s3')->exists($bucket->getRawOriginal('image')))
            Storage::disk('s3')->delete($bucket->getRawOriginal('image'));
        if ($bucket->delete())
            return redirect()->back()->with('message', 'Image Deleted successfully');
    }


    public function s3Image(Bucket $bucket)
    {
        try
        {
            $images = Storage::disk('s3')->get($bucket->image);

            return response($images)->header('Content-Type', 'image');
        }
        catch (\Exception $exception)
        {
            return $exception->getMessage();
        }
    }
}
