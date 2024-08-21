<?php

namespace App\Http\Api;

use Illuminate\Http\Request;

class Api {
    public function connect(Request $request) {
        $type = "";
        if(isset($request->Type)) {
            $type = $request->Type;
        }

        if($type == "Bandle") {
            require_once('Bandle/BandleApi.php');
        }
        else if($type == "BandleBlock") {
            require_once('Bandle/BlockApi.php');
        }
        else {
            echo 'No Type';
        }
    }
}