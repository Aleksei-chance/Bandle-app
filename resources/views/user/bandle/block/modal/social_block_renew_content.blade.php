@foreach ($items as $item)
<div class="link_container" id="">
    <label for="link_{{ $item['id'] }}" class="input_block link_field" id="link_block_{{ $item['id'] }}">
        @if ($item['icon'] != '')
            <i class="block_icon url_link_icon" style="background-image: url('{!! $item['icon'] !!}')"></i>
        @else
            <i class="block_icon link_icon"></i>
        @endif
        <input type="text" class="link_input" placeholder="Link" id="link_{{ $item['id'] }}"  oninput="input_valid(this)" onchange="bandle_block_renew_social_link(this, {{ $item['id'] }}, {{ $block_id }})" value="{{ $item['link'] }}">
        <button class="input_btn link_input_btn" onclick="input_action(this);">
            @if ($item['link'] != "")
                <i class="icon_small icon_clear"></i>
            @else
                <i class="icon_small icon_send"></i>
            @endif
        </button>
    </label>
</div>
@endforeach
@if (count($items) < 6)
    <div class="add_field_container" id="link_add_btn" onclick="bandle_block_link_add_item()">
        <div class="add_field">
            add field
        </div>
        <i class="block_icon icon_add"></i>
    </div>
    <div class="link_container d_none" id="link_add_input">
        <div class="input_block link_field" id="link_block">
            <i class="block_icon link_icon"></i>
            <input type="text" class="link_input" placeholder="Link" id="link_add"  oninput="input_valid(this)" onchange="bandle_block_link_add_item_send(this, {{ $block_id }})" value="">
            <button class="input_btn link_input_btn" onclick="input_action(this);">
                <i class="icon_small icon_send"></i>
            </button>
        </div>
    </div>
@endif