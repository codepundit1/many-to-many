<?php

namespace App\Http\Controllers\Api;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CarResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{

    public function index()
    {
        $cars = Car::latest()->paginate(2);
        return CarResource::collection($cars);
    }


    public function store(Request $request)
    {
        $valid = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'driver_id' => ['required', 'integer'],
            'car_number' => ['required', 'integer', 'digits_between:5,20', 'unique:cars'],
            'model' => ['nullable', 'string', 'max:9999'],
            'price' => ['nullable', 'numeric', 'gt:0'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('cover_image')) {
            try {
                $valid['cover_image'] = $request->file('cover_image')->store('CarImages', 's3');
            } catch (\Exception $exception) {
                return back()->with('error', $exception->getMessage());
            }
        }

        $car = Car::create($valid);

        if ($car)
            return response()->json(['message' => 'Car successfully created', 'data' => new CarResource($car)]);
        return response()->json(['error' => 'Something went wrong'], 500);
    }


    public function show($id)
    {
        return new CarResource(Car::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $valid = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'driver_id' => ['required', 'integer'],
            'car_number' => ['required', 'integer', 'digits_between:5,20', 'unique:cars,car_number,' . $car->id],
            'model' => ['nullable', 'string', 'max:9999'],
            'price' => ['nullable', 'numeric', 'gt:0'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('cover_image')) {
            try {
                if (Storage::disk('s3')->exists($car->cover_image))
                    Storage::disk('s3')->delete($car->cover_image);

                $valid['cover_image'] = $request->file('cover_image')->store('CarImages', 's3');
            } catch (\Exception $exception) {
                return back()->with('error', $exception->getMessage());
            }
        }

        if ($car->update($valid))
            return response()->json([
                'message' => 'Car successfully updated',
                'data' => new CarResource($car->fresh())
            ]);
        return response()->json(['error' => 'Something went wrong'], 500);
    }


    public function destroy($id)
    {
    }
}
