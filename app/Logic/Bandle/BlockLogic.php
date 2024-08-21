<?php

namespace App\Logic\Bandle;

use App\Models\Bandle;
use App\Models\Block;
use App\Models\BlockType;
use App\Models\NameBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlockLogic {
    public function load_items($bandle_id) {
        $arr = array();
        $arr['id'] = $bandle_id;
        
        $arr['items'] = Bandle::query()->find($bandle_id)->blocks()->get()->toArray();
    
        return view('user.bandle.block.items', $arr);
    }

    public function add_item($bandle_id) {
        $arr['id'] = $bandle_id;
        $items = BlockType::all();
        $arr["items"] = array();
        foreach($items as $item) {
            $limit = BlockType::query()->find($item->id)->limit;
            $count = Bandle::query()->find($bandle_id)->blocks_count();
            if($count < $limit) {
                $arr["items"][] = $item->toArray();
            }
        }
    
        return view('user.bandle.block.modal.block_item_add', $arr);
    }

    public function add_item_send($bandle_id, $type_id) {
        $user_id = Auth::id();
        $limit = BlockType::query()->find($type_id)->limit;
        $count = Bandle::query()->find($bandle_id)->blocks_count();
        if($count < $limit && $block = Block::create([
            'bandle_id' => $bandle_id
            , 'user_id' => $user_id
            , 'block_type_id' => $type_id
        ])) {
            if($type_id == 1 && NameBlock::query()->create([
                'block_id' => $block->id
                , 'user_id' => $user_id
            ])) {
                return 1;
            }
            
        }
        return 0;
    }

    public function access($id) {
        $block = Block::query()->find($id);
        $user_id = Auth::id();
        if($user_id == $block->user_id) {
            return 1;
        }
        return 0;
    }

    public function load_content($id) {
        $block_type_id = Block::query()->find($id)->block_type_id;
        if($block_type_id == 1) {
            $content = Block::query()->find($id)->name_content()->toArray();

            return view('user.bandle.block.name_block', $content);
        }
        return 0;
    }

    public function renew_item($id) {
        $block_type_id = Block::query()->find($id)->block_type_id;
        if($block_type_id == 1) {
            $content = Block::query()->find($id)->name_content()->toArray();
            $content['block_id'] = $id;
            return view('user.bandle.block.modal.name_block_renew', $content);
        }
    } 

    public function renew_item_send($id, Request $request) {
        $block_type_id = Block::query()->find($id)->block_type_id;
        if($block_type_id == 1) {
            $content_id = Block::query()->find($id)->name_content()->id;
            return $this->name_block_renew($content_id, $request);
        }
        return 0;
    } 

    public function name_block_renew($name_block_id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['nullable', 'string', 'max:100']
            , 'article' => ['nullable', 'string', 'max:50']
            , 'pronouns' => ['nullable', 'string', 'max:25']
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

        $name_block = NameBlock::query()->find($name_block_id);
        foreach ($data as $key => $item) {
            $name_block->$key = $item;
        }
    
        if($name_block->save()) {
            return 1;
        }
        return 0;
    }

    public function remove_item($id) {
        $arr = array(
            'id' => $id
            , 'bandle_id' => Block::query()->find($id)->bandle_id
        );
        return view('user.bandle.block.modal.item_remove', $arr);
    }

    public function remove_item_send($id) {
        $block = Block::query()->find($id);
        $block->hidden = 1;
        if($block->save()) {
            $block_type_id = Block::query()->find($id)->block_type_id;
            if($block_type_id == 1) {
                $name_block_id = Block::query()->find($id)->name_content()->id;
                $name_block = NameBlock::query()->find($name_block_id);
                $name_block->hidden = 1;
                if($name_block->save()) {
                    return 1;
                }
            }
        }
        return 0;
    }
    
}