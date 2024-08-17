<?php


include(app_path().'/functions/bandle/loader.php');

$type = "";
if(isset($request->Type)) {
    $type = $request->Type;
}

if($type == "Bandle") {
    require_once('Bandle.php');
}

else {
    echo 'No Type';
}