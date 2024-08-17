<?php

namespace App\Http\Controllers;

use App\Models\bandle;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function MyBandles() {

        $arr["type"] = 'bandle_list';
        $arr["type_view"] = 0;
        return view('user.index', $arr);
    }

    public function bandle(bandle $bandle) {
        if(Auth::id() == $bandle->user_id && $bandle->publish && !$bandle->hidden) {
            $arr["type"] = 'bandle';
            $arr["items"] = Block::query()->where('user_id', $bandle->id)->where('user_id', Auth::id())->where('publish', 1)->where('hidden', 0)->get()->toArray();
            return view('user.index', array_merge($bandle->toArray(), $arr));
        }
        return redirect('/MyBandles');
    }
}
