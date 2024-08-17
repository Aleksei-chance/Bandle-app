<div id="bandle_item_and" class="modal_body">
    <div class="modal_header">
        <button class="modal_btn_close text_black" onclick="modal_hide();">
            <i class="modal_close"></i>
            Back
        </button>
        <p class="text_black text_title">New Bande</p>
        <div style="width: 70px;"></div>
    </div>
    <div class="modal_content">
        <div class="input_block" id="title_block">
            <input type="text" class="input_simple text_black" placeholder="Title" id="title"  oninput="input_valid(this)">
            <p class="error_text"></p>
        </div>
        <div class="input_block" id="description_block">
            <input type="text" class="input_simple text_black" placeholder="Description" id="description"  oninput="input_valid(this)">
        </div>
        
    </div>
    <button class="modal_main_small" onclick="bandle_item_add_send()">Create</button>
</div>

<script>
    modal('show', 'bandle_item_and');
</script>