<ul class="inner" style="left:-55px;">
    @foreach (json_decode($product->photos) as $key => $photo)
        <a href="{{ route('product', $product->slug) }}" title=""><img src="{{ my_asset($photo) }}"/></a>
    @endforeach
</ul>