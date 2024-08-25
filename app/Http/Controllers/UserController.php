<?php

namespace App\Http\Controllers;

use App\Http\Api\Api;
use App\Models\bandle;
use App\Models\Block;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function MyBandles() {
        
        $arr["type"] = 'bandle_list';
        $arr["type_view"] = 0;
        return view('user.index', $arr);
    }

    public function bandle(bandle $bandle) {

        // $url = 'http://www.google.com/s2/favicons?domain=trtyu.gt&sz=128';
        // // $path = $icon->store('icons');
        // // $contents = file_get_contents($url);
        // var_dump(parse_url($url));
        // // $name = substr($url, strrpos($url, '/') + 1);
        // // Storage::put($name, $contents);
        // exit();

        if(Auth::id() == $bandle->user_id && $bandle->publish && !$bandle->hidden) {
            $arr["type"] = 'bandle';
            // 
            $arr["func"] = 'bandle_block_items_load('.$bandle->id.')';
            return view('user.index', array_merge($bandle->toArray(), $arr));
        }
        return redirect('/MyBandles');
  
    }
}

