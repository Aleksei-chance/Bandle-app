<div class="bandle_item">
    <div class="bandle_head">
        <button class="modal_btn_close text_black" onclick="location.href='/MyBandles'">
            <i class="modal_close"></i>
            Back
        </button>
        <p class="text_black text_title">{{ $title }}</p>
        <div style="width: 70px;" class="btn_zero">
            <button class="btn_bandle_edit" onclick="bandle_renew_item({{ $id }}, 'location')"></button>
        </div>
    </div>
    <div class="bandle_item_content" id="bandle_item_content">
        
    </div>
    <div class="modal_header" style="justify-content: center;">
        <button class="bandle_add_btn" onclick="bandle_block_item_add({{ $id }})">
            <i class="bandle_add_btn_icon"></i>
            Add
        </button>
    </div>
</div>