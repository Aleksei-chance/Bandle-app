<?php

use App\Logic\Bandle\BandleLogic;

$func = "";
if(isset($request->func)) {
    $func = $request->func;
}

$id = 0;
if(isset($request->id)) {
    $id = $request->id;
}

$Bundle = New BandleLogic;
if($func == "items_load" && isset($request->type_view)) {
    echo $Bundle->load_items($request->type_view);
} 
else if($func == "item_add") {
    echo $Bundle->add_item();
} 
else if($func == "item_add_send") {
    echo $Bundle->add_item_send($request);
} 
else if($id > 0 && $Bundle->access($id)) {
    if($func == "renew_item") {
        echo $Bundle->renew_item($id, $request);
    } 
    else if($func == "renew_item_send") {
        echo $Bundle->renew_item_send($id, $request);
    } 
    else if($func == "remove_item") {
        echo $Bundle->remove_item($id, $request);
    } 
    else if($func == "remove_item_send") {
        echo $Bundle->remove_item_send($id);
    } 

    else {
        echo 'No func';
    }
}

else {
    echo 'No func';
}