    <!-- Products Start -->
    @foreach ($categories_with_product as $category)
        @if ($category->productWithCategoryActive->count() == 0)
            @continue;
        @endif
        <div class="container-fluid pt-5">
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2">{{ $category->name }}</span></h2>
            </div>
            <div class="row px-xl-5 pb-3">
                @foreach ($category->productWithCategoryActive->take(4) as $product)
                    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <a href="{{ route('frontend.product.detail', ['slug' => $product->slug]) }}">
                                <div
                                    class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100 image_product"
                                        src="{{ asset('admin/images/products/' . $product->image_url) }}"
                                        alt="">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3 ml-2">{{ $product->name }}</h6>
                                    <div class="d-flex justify-content-left">
                                        @if ($product->is_displayed_price == 0)
                                            <h6 class="ml-2">Giá: Liên hệ</h6>
                                        @else
                                            <h6 class="ml-2">Giá: {{ formatPrice(floatval($product->price)) }}</h6>
                                        @endif
                                        {{-- <h6 class="text-muted ml-2"><del>{{ formatPrice($product->price) }}</del></h6> --}}
                                    </div>
                                </div>
                                <div class="card-footer d-flex  justify-content-left bg-light border">
                                    <a href="{{ route('frontend.product.detail', ['slug' => $product->slug]) }}"
                                        class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem
                                        chi
                                        tiết</a>
                                    {{-- <a href="" class="btn btn-sm text-dark p-0"><i
                                        class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a> --}}
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <!-- Products End -->
