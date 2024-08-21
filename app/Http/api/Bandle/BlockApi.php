<?php

use App\Logic\Bandle\BandleLogic;
use App\Logic\Bandle\BlockLogic;

$func = "";
if(isset($request->func)) {
    $func = $request->func;
}

$id = 0;
if(isset($request->id)) {
    $id = $request->id;
}
$bandle_id = 0;
if(isset($request->bandle_id)) {
    $bandle_id = $request->bandle_id;
}

$Bundle = New BandleLogic;
$Block = New BlockLogic;

if($id > 0 && $Block->access($id)) {
    if($func == "load_content") {
        echo $Block->load_content($id);
    } 
    else if($func == "renew_item") {
        echo $Block->renew_item($id);
    } 
    else if($func == "renew_item_send") {
        echo $Block->renew_item_send($id, $request);
    } 
    else if($func == "remove_item") {
        echo $Block->remove_item($id);
    }
    else if($func == "remove_item_send") {
        echo $Block->remove_item_send($id);
    }
    else {
        echo 'No func';
    }
}

else if($bandle_id > 0 && $Bundle->access($bandle_id)) {
    if($func == "items_load") {
        echo $Block->load_items($bandle_id);
    } 
    else if($func == "item_add") {
        echo $Block->add_item($bandle_id);
    } 
    else if($func == "item_add_send" && isset($request->type_id)) {
        echo $Block->add_item_send($bandle_id, $request->type_id);
    } 
    else {
        echo 'No func';
    }
}
else {
    echo 'No func';
}