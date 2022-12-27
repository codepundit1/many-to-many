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
        $cars = Car::latest()->get();
        return CarResource::collection($cars);
    }


    public function store(Request $request)
    {
    }


    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
    }


    public function destroy($id)
    {
    }
}
