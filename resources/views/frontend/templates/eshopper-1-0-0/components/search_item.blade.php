    <a class="dropdown-item" href="#"> <i class="fa fa-search"></i> {{ request()->name }}</a>
    @if (@$product_detail)
        @foreach ($product_detail as $product)
            <a class="dropdown-item"
                href="{{ route('frontend.product.detail', ['slug' => @$product->slug]) }}">{{ @$product->name }}</a>
        @endforeach
    @endif
