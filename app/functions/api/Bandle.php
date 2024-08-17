<?php

$func = "";
if(isset($request->func)) {
    $func = $request->func;
}

$id = 0;
if(isset($request->id)) {
    $id = $request->id;
}

if($func == "items_load" && isset($request->type_view)) {
    echo bandle_items_load($request->type_view);
} 
else if($func == "item_add") {
    echo bandle_item_add();
} 
else if($func == "item_add_send") {
    echo bandle_item_add_send($request);
} 
else if($id > 0 && bandle_acsses($id)) {
    if($func == "renew_item") {
        echo bandle_renew_item($id, $request);
    } 
    else if($func == "renew_item_send") {
        echo bandle_renew_item_send($id, $request);
    } 
    else if($func == "remove_item") {
        echo bandle_remove_item($id, $request);
    } 
    else if($func == "remove_item_send") {
        echo bandle_remove_item_send($id);
    } 

    else {
        echo 'No func';
    }
}

else {
    echo 'No func';
}