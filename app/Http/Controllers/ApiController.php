<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Api\Api;

class ApiController extends Controller
{
    public function Api(Request $request, Api $api) {
        // include(app_path().'/functions/api/loader.php');
        return $api->connect($request);
    }
}
