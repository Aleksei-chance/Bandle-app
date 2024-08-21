<?php

namespace App\Logic\Bandle;

use App\Models\bandle;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BandleLogic {
    public function load_items($type_view) {
        $user_id = Auth::id();
        $limit = Auth::user()->bandle_limit;
        $arr['items'] = User::query()->find($user_id)->bandles()->get()->toArray();
        $arr['add_avalable'] = false;
        if(count($arr['items']) < $limit) {
            $arr['add_avalable'] = true;
        }
        if($type_view == 0) {
            return view('user.bandle.items', $arr);
        }
    }

    public function add_item() {
        return view('user.bandle.modal.add_item');
    }

    public function add_item_send($request) {
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

    public function access($id) {
        $bandle = Bandle::query()->find($id);
        $user_id = Auth::id();
        if($user_id == $bandle->user_id) {
            return 1;
        }
        return 0;
    }

    public function renew_item($id, $request) {
        $arr = array();
        $bandle = Bandle::query()->find($id);
        $arr['func'] = '';
        if(isset($request->Func)) {
            $arr['func'] = $request->Func;
        }
    
        if($bandle) {
            return view('user.bandle.modal.renew_item', array_merge($bandle->toArray(), $arr) );
        }
        
        return 0;
    }

    public function renew_item_send($id, $request) {
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

    public function remove_item($id, $request) {
        $arr = array();
        $arr['func'] = '';
        if(isset($request->Func)) {
            $arr['func'] = $request->Func;
        }
        if($bandle = Bandle::query()->find($id)) {
            return view('user.bandle.modal.remove_item', array_merge($bandle->toArray(), $arr));
        }
        return 0;
    }


    public function remove_item_send($id) {
        $bandle = Bandle::query()->find($id);
        $bandle->hidden = 1;
        if($bandle->save()) {
            return 1;
        }
        return 0;
    }
}