<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DriverResource;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    public function __invoke(Request $request)
    {
        $drivers = Driver::orderBy('name')->get();
        return DriverResource::collection($drivers);
    }
}
