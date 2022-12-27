<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    public function index()
    {
        $drivers = Driver::latest()->paginate();

        return view('drivers.index', compact('drivers'));
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:drivers'],
            'phone' => ['required', 'string', 'max:255', 'unique:drivers'],
            'address' => ['required', 'string', 'max:255'],
            'registration_no' => ['nullable', 'string', 'max:255', 'min:10'],
            'nid_no' => ['nullable', 'string', 'max:255', 'min:10'],
        ]);

        if (Driver::create($valid))
            return redirect()->route('drivers.index')->with('success', 'Driver Created Successfully');

        return back()->with('error', 'Something went wrong');
    }

    public function create()
    {
        return view('drivers.create');
    }


    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $valid = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:drivers,email,' . $driver->id],
            'phone' => ['required', 'string', 'max:255', 'unique:drivers,phone,' . $driver->id],
            'address' => ['required', 'string', 'max:255'],
            'registration_no' => ['nullable', 'string', 'max:255', 'min:10'],
            'nid_no' => ['nullable', 'string', 'max:255', 'min:10'],
        ]);

        if ($driver->update($valid))
            return redirect()->route('drivers.index')->with('success', 'Driver Updated Successfully');

        return back()->with('error', 'Something went wrong');
    }

    public function destroy(Driver $driver)
    {
        if ($driver->delete())
            return back()->with('success', 'Driver Deleted Successfully');

        return back()->with('error', 'Something went wrong');
    }
}
