@if (count($items) > 0)
    <div class="social_link_content">
        @foreach ($items as $item)
            <span class="social_link_item" onclick="window.open('https://{!! $item['link'] !!}')">
                @if ($item['icon'] != '')
                    <i class="block_icon url_link_icon" style="background-image: url('{!! $item['icon'] !!}')"></i>
                @else
                    <i class="block_icon link_icon"></i>
                @endif
            </span>
        @endforeach
    </div>
@else
    <i class="block_icon social_block_icon"></i>
@endif
