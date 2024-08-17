<div id="bandle_item_remove" class="remove_modal_body">
    <div class="remove_modal_content">
        <p class="text_black text_center">Delete this Bandle?</p>
    </div>
    <div class="remove_modal_btn_group">
        <button class="remove_modal_btn text_red border_right" onclick="bandle_remove_item_send({!! $id !!})">Delete</button>
        <button class="remove_modal_btn" onclick="modal_hide()" >Cancel</button>
    </div>
</div>

{{-- <div id="bandle_item_remove" class="modal_body">
    <div class="modal_header">
        <div style="width: 85px;"></div>
        <p class="text_black text_title">Bande delete</p>
        <div style="width: 85px;"></div>
    </div>
    <div class="modal_content">
        <p class="text_black text_center">Are you sure?</p>
    </div>
    <div class="modal_btn_group">
        <button class="modal_main_small" onclick="modal_hide()" style="width: 62px">No</button>
        <button class="modal_main_small modal_btn_white" onclick="bandle_remove_item_send({!! $id !!})">Yes</button>
    </div>
</div> --}}

<script>
    modal('show', 'bandle_item_remove');
</script>