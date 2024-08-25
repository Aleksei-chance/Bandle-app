<div id="name_block_renew" class="modal_body">
    <div class="modal_header">
        <button class="modal_btn_close text_black" onclick="modal_hide();">
            <i class="modal_close"></i>
            Cancel
        </button>
        <div class="title_with_icon">
            <i class="name_card_icon"></i>
            <p class="text_black text_title">Name</p>
        </div>
        <div style="width: 85px;"></div>
    </div>
    <div class="modal_content">
        <div class="input_block" id="name_block">
            <input type="text" class="input_simple text_black" placeholder="Name" id="name"  oninput="input_valid(this)" value="{!! $name !!}">
            <p class="error_text"></p>
        </div>
        <div class="input_block" id="article_block">
            <input type="text" class="input_simple text_black" placeholder="Article" id="article"  oninput="input_valid(this)" value="{!! $article !!}">
            <p class="error_text"></p>
        </div>
        <div class="input_block" id="pronouns_block">
            <input type="text" class="input_simple text_black" placeholder="Pronouns" id="pronouns"  oninput="input_valid(this)" value="{!! $pronouns !!}">
            <p class="error_text"></p>
        </div>
    </div>
    <button class="modal_main_small" onclick="bandle_block_renew_item_send({{ $block_id }})">Done</button>
</div>

<script>
    modal('show', 'name_block_renew');
</script>