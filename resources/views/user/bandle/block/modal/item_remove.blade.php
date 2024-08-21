<div id="block_item_remove" class="remove_modal_body">
    <div class="remove_modal_content">
        <p class="text_black text_center">Delete this block?</p>
    </div>
    <div class="remove_modal_btn_group">
        <button class="remove_modal_btn text_red border_right" onclick="bandle_block_remove_item_send({{ $id }}, {{ $bandle_id }})">Delete</button>
        <button class="remove_modal_btn" onclick="modal_hide()" >Cancel</button>
    </div>
</div>

<script>
    modal('show', 'block_item_remove');
</script>