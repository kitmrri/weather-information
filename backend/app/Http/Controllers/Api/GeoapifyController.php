<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OpenGeoapify;
use Illuminate\Http\Request;
use App\Models\Geoapify;

class GeoapifyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $geoapify = Geoapify::where(['city' => $request->get('city')])->get();

        return response()->json($geoapify);
    }
}
