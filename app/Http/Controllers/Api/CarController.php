<?php

namespace App\Http\Controllers\Api;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Resources\CarResource;
use App\Http\Controllers\Controller;

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

        if ($request->hasFile('cover_image'))
        {
            try
            {
                $valid['cover_image'] = $request->file('cover_image')->store('CarImages', 's3');
            }
            catch (\Exception $exception)
            {
                return back()->with('error', $exception->getMessage());
            }
        }

        $car = Car::create($valid);

        if($car)
            return response()->json(['message' => 'Car successfully created', new CarResource($car)]);
        return response()->json(['error' => 'Something went wrong'], 500);
    }


    public function show($id)
    {
        return new CarResource(Car::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
    }


    public function destroy($id)
    {
    }
}
