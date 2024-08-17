<?php

namespace App\Http\Controllers;

use App\Models\bandle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function MyBandles(Request $request) {

        $arr["type"] = 'bandle';
        $arr["type_view"] = 0;
        return view('user.index', $arr);
    }
}
