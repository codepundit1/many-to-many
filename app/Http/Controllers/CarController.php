<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('driver')->latest()->paginate();

        return view('cars.index', compact('cars'));
    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        $drivers = Driver::orderBy('name')->get();

        return view('cars.edit', compact('car', 'drivers'));
    }

    public function update(Request $request, Car $car)
    {
        $valid = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'driver_id' => ['required', 'integer'],
            'car_number' => ['required', 'integer', 'digits_between:5,20', 'unique:cars,isbn,' . $car->id],
            'model' => ['nullable', 'string', 'max:9999'],
            'price' => ['nullable', 'numeric', 'gt:0'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('cover_image')) {
            try
            {
                if (Storage::disk('s3')->exists($car->cover_image))
                    Storage::disk('s3')->delete($car->cover_image);

                $valid['cover_image'] = $request->file('cover_image')->store('CarImages', 's3');
            }
            catch (\Exception $exception)
            {
                return back()->with('error', $exception->getMessage());
            }
        }

        if ($car->update($valid))
            return redirect()->route('cars.index')->with('success', 'Car Updated Successfully');

        return back()->with('error', 'Something went wrong');
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

        if (Car::create($valid))
            return redirect()->route('cars.index')->with('success', 'Car Created Successfully');

        return back()->with('error', 'Something went wrong');
    }

    public function create()
    {
        $drivers = Driver::orderBy('name')->get();

        return view('cars.create', compact('drivers'));
    }

    public function destroy(Car $car)
    {
        if ($car->delete())
            return back()->with('success', 'Car Deleted Successfully');

        return back()->with('error', 'Something went wrong');
    }

    public function carImage(Car $car)
    {
        try {
            $image = Storage::disk('s3')->get($car->cover_image);

            return response($image)->header('Content-Type', 'image');
        }
        catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
