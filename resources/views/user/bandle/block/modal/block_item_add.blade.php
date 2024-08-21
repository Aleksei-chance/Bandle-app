<div id="bandle_item_and" class="modal_body bandle_item_add_body">
    <div class="modal_header bandle_item_add_head">
        <button class="modal_btn_close text_black" onclick="modal_hide();">
            <i class="modal_close"></i>
            Cancel
        </button>
        <div class="title_with_icon">
            <i class="block_modal_add_item"></i>
            <p class="text_black text_title">Add</p>
        </div>
        
        <div style="width: 85px;"></div>
    </div>
    @foreach ($items as $item)
        <div class="block_add_item_block" onclick="bandle_block_item_add_send({{ $id }}, {{ $item['id'] }})">
            <i class="{{ $item["icon"] }}"></i>
            <div class="block_add_item_text">
                <p class="block_add_item_name">{{ $item["name"] }}</p>
                <p class="block_add_item_description">{{ $item["description"] }}</p>
            </div>
        </div>
    @endforeach
</div>

<script>
    modal('show', 'bandle_item_and');
</script>