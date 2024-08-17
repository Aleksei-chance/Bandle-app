<?php

use App\Models\Bandle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Type\Integer;

function bandle_items_load($type_view) {
    $id_user = Auth::id();
    $limit = Auth::user()->bandle_limit;

    
    $arr['items'] = Bandle::query()->where('user_id', $id_user)->where('publish', '1')->where('hidden', '0')->get()->toArray();

    $arr['add_avalable'] = false;
    if(count($arr['items']) < $limit) {
        $arr['add_avalable'] = true;
    }

    if($type_view == 0) {
        return view('user.bandle.items', $arr);
    }
}

function bandle_item_add() {
    return view('user.bandle.modal.add_item');
}

function bandle_item_add_send($request) {
    $validator = Validator::make($request->all(), [
        "title" => ["required", 'string', 'max:100']
        , 'description' => ['nullable', 'string']
    ]);

    // var_dump($validator); exit();

    if ($validator->fails()) 
    {
        $messages = $validator->errors()->messages();
        $errors = array();
        foreach($messages as $key => $massage) {
            foreach($massage as $Item) {
                $errors[] = $key.":".$Item;
            }
        }
        return implode("|", $errors);
    }

    $data = $validator->validated();
    $data['user_id'] = Auth::id();
    if(Bandle::create($data)) {
        return 1;
    }
    return 0;
}

function bandle_renew_item($id) {
    $arr = array();

    $bandle = Bandle::query()->find($id);

    if($bandle) {
        return view('user.bandle.modal.renew_item', $bandle->toArray());
    }
    
    return 0;
}

function bandle_acsses($id) {
    $bandle = Bandle::query()->find($id);
    $id_user = Auth::id();
    if($id_user == $bandle->user_id) {
        return 1;
    }
    return 0;
}

function bandle_renew_item_send($id, $request) {
    $validator = Validator::make($request->all(), [
        "title" => ["required", 'string', 'max:100']
        , 'description' => ['nullable', 'string']
    ]);

    if ($validator->fails()) 
    {
        $messages = $validator->errors()->messages();
        $errors = array();
        foreach($messages as $key => $massage) {
            foreach($massage as $Item) {
                $errors[] = $key.":".$Item;
            }
        }
        return implode("|", $errors);
    }

    $data = $validator->validated();

    $bandle = Bandle::query()->find($id);
    foreach ($data as $key => $item) {
        $bandle->$key = $item;
    }

    if($bandle->save()) {
        return 1;
    }
    return 0;
}

function bandle_remove_item($id) {
    $arr = array();
    if($bandle = Bandle::query()->find($id)) {
        return view('user.bandle.modal.remove_item', $bandle->toArray());
    }
    return 0;
}

function bandle_remove_item_send($id) {
    $bandle = Bandle::query()->find($id);
    $bandle->hidden = 1;
    if($bandle->save()) {
        return 1;
    }
    return 0;
}