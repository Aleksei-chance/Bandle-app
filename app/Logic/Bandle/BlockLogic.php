<?php

namespace App\Logic\Bandle;

use App\Models\Bandle;
use App\Models\Block;
use App\Models\BlockType;
use App\Models\NameBlock;
use App\Models\SocialLink;
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
            if($count < $limit || $limit == 0) {
                $arr["items"][] = $item->toArray();
            }
        }
    
        return view('user.bandle.block.modal.block_item_add', $arr);
    }

    public function add_item_send($bandle_id, $type_id) {
        $user_id = Auth::id();
        $limit = BlockType::query()->find($type_id)->limit;
        $count = Bandle::query()->find($bandle_id)->blocks_count();
        $max = Bandle::query()->find($bandle_id)->blocks()->max('sort');
        $max++;
        if(($count < $limit || $limit == 0) && $block = Block::create([
            'bandle_id' => $bandle_id
            , 'user_id' => $user_id
            , 'block_type_id' => $type_id
            , 'sort' => $max
        ])) {
            if($type_id == 1 && NameBlock::query()->create([
                'block_id' => $block->id
                , 'user_id' => $user_id
            ])) {
                return 1;
            } else if($type_id == 2) {
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
        } else if($block_type_id == 2) {
            $arr = array(
                'id' => $id
                , 'items' => Block::query()->find($id)->social_links()->get()->toArray()
            );

            return view('user.bandle.block.social_block', $arr);
        }
        return 0;
    }

    public function renew_item($id) {
        $block_type_id = Block::query()->find($id)->block_type_id;
        if($block_type_id == 1) {
            $content = Block::query()->find($id)->name_content()->toArray();
            $content['block_id'] = $id;
            return view('user.bandle.block.modal.name_block_renew', $content);
        } else if ($block_type_id == 2) {
            $content = array(
                'block_id' => $id
                , 'items' => Block::query()->find($id)->social_links()->get()->toArray()
            );
            return view('user.bandle.block.modal.social_block_renew', $content);
        }
        return 0;
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
            } else if($block_type_id == 2) {
                return 1;
            }
        }
        return 0;
    }

    public function add_social_link($id, $link) {
        $count = Block::query()->find($id)->social_links_count();
        $max = Block::query()->find($id)->social_links()->max('sort');
        $max++;

        $link = $this->parse_link($link);
        $icon = $this->get_icon_by_link($link);

        if($count < 6 && SocialLink::query()->create([
            'block_id' => $id
            , 'user_id' => Auth::id()
            , 'icon' => $icon
            , 'link' => $link
            , 'sort' => $max
        ])) {
            return 1;
        }
        return 0;
    }

    public function parse_link($link) {
        $url = parse_url($link);
        if(isset($url['host'])) {
            $link = $url['host'];
            if(isset($url['path'])) {
                $link .= $url['path'];
            }
            if(isset($url['query'])) {
                $link .= '?'.$url['query'];
            }
        }
        return $link;
    }

    public function get_icon_by_link($link) {
        $icon = $host = "";
        $url = parse_url($link);
        if(isset($url['host'])) {
            $host = $url['host'];
        } else {
            $arr = explode('/', $link);
            $host = $arr[0];
        }
        $url = 'http://www.google.com/s2/favicons?domain='.$host.'&sz=128';
        if(file_get_contents($url)) 
        {
            $icon = $url;
        }
        return $icon;
    }

    public function social_link_access($link_id) {
        $social_link = SocialLink::query()->find($link_id)->user_id;
        $user_id = Auth::id();
        if($social_link == $user_id) {
            return 1;
        }
        return 0;
    }

    public function renew_social_link($link_id, $value) {
        $social_link = SocialLink::query()->find($link_id);
        if($value != "") {
            $social_link->link = $value;
            if($social_link->save()) {
                return 1;
            }
        } else {
            $social_link->hidden = 1;
            if($social_link->save()) {
                return 1;
            }
        }
        return 0;
    }

    public function renew_social_link_content($id) {
        $content = array(
            'block_id' => $id
            , 'items' => Block::query()->find($id)->social_links()->get()->toArray()
        );
        return view('user.bandle.block.modal.social_block_renew_content', $content);
    }
    
}