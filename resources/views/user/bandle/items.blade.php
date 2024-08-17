<div class="bandle_list">
    @foreach ($items as $item)
        <div class="bandle_block "  style="cursor: pointer">
            <div class="bandle bandle_center bundle_action" id="bandle_{{ $item["id"] }}"></div>
            <div class="bandle_tytle_zone">
                <div class="bandle_tytle">{{ $item["title"] }}</div>
            </div>
            
        </div>
    @endforeach
    @if ($add_avalable)
        <div class="bandle_block bandle_add_hover" style="cursor: pointer" onclick="bandle_item_add();">
            <div class="bandle bandle_center">
                <i class="bandle_add"></i>
            </div>
            <div class="add_bandle_tytle">
                Create a new bandle
            </div>
        </div>
    @endif
</div>