@if (count($items) > 0)
    @foreach ($items as $item)
        <div class="block block_action" id="block_{{ $item['id'] }}">
            <div class="block_content" id="block_{{ $item['id'] }}_content">

            </div>
            <div class="block_remove" onclick="bandle_block_remove_item({{ $item['id'] }})">
                􀈒 Delete
            </div>
        </div>
    @endforeach
@else
    <br><br><br><br>
    <center>Add first block!</center>
    <br><br><br><br>
@endif

<script>
    bandle_block_items_load_content();
</script>