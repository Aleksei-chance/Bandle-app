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
$link_id = 0;
if(isset($request->link_id)) {
    $link_id = $request->link_id;
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
    else if($func == "add_social_link" && isset($request->link)) {
        echo $Block->add_social_link($id, $request->link);
    }
    else if($func == "renew_social_link_content") {
        echo $Block->renew_social_link_content($id);
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

else if($link_id > 0 && $Block->social_link_access($link_id)) {
    if($func == "renew_social_link") {
        echo $Block->renew_social_link($link_id, $request->value);
    } 
    else {
        echo 'No func';
    }
}

else {
    echo 'No func';
}