<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CitiesController extends Controller
{
    public function getCities()
    {
        $cities = City::pluck('name');

        return response()->json($cities);
    }
}
