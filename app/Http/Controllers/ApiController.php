<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function Api(Request $request) {
        include(app_path().'/functions/api/loader.php');
    }
}
