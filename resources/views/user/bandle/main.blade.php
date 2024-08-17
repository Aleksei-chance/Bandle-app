<div class="navigation_bar">
    <img src="{{ asset('svg/Logo-title-1.svg') }}">
    <div class="navigation_btns">
        <button class="nav_button nav_set"></button>
    </div>
</div>
<div class="bandle_container" id="bandle_container">

</div>
<div class="toolbar">
    {{-- <button class="saved_btn"></button>
    <div class="toolbar_separator"></div> --}}
    <button class="my_bandle_btn @if ($type_view == 0) my_active @endif"></button>
</div>
<script>
    bandle_items_load({!! $type_view !!});
</script>