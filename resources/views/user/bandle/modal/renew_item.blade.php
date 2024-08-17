<div id="bandle_item_renew" class="modal_body">
    <div class="modal_header">
        <button class="modal_btn_close text_black" onclick="modal_hide();">
            <i class="modal_close"></i>
            Cancel
        </button>
        <p class="text_black text_title">Bande renew</p>
        <div style="width: 85px;"></div>
    </div>
    <div class="modal_content">
        <div class="input_block" id="title_block">
            <input type="text" class="input_simple text_black" placeholder="Title" id="title"  oninput="input_valid(this)" value="{!! $title !!}">
            <p class="error_text"></p>
        </div>
        <div class="input_block" id="description_block">
            <input type="text" class="input_simple text_black" placeholder="Description" id="description"  oninput="input_valid(this)" value="{!! $description !!}">
        </div>
        
    </div>
    <div class="modal_btn_group">
        <button class="modal_btn_remove" onclick="bandle_remove_item({!! $id !!})">􀈑 Delete</button>
        <button class="modal_main_small" onclick="bandle_renew_item_send({!! $id !!})" style="width: 108px;">Done</button>
    </div>
</div>

<script>
    modal('show', 'bandle_item_renew');
</script>