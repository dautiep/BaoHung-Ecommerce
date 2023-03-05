    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">{{ config('page.filter_product.name') }}</h5>
                    <form>
                        @php
                            $request_target_filter = request()->targetRanger ? json_decode(request()->targetRanger) : ['price-all'];
                        @endphp
                        @foreach (@$categories_with_product_filter as $rangerFilter)
                            <div
                                class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input filter-ranger"
                                    {{ in_array(@$rangerFilter['id'], @$request_target_filter) ? 'checked' : '' }}
                                    id="{{ @$rangerFilter['id'] }}">
                                <label class="custom-control-label"
                                    for="{{ @$rangerFilter['id'] }}">{{ $rangerFilter['label'] }}</label>
                                <span
                                    class="badge border font-weight-normal">{{ @$rangerFilter['total_product'] }}</span>
                            </div>
                        @endforeach

                    </form>
                </div>

            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    @foreach ($categories_with_product->productWithCategory as $product)
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <a href="{{ route('frontend.product.detail', ['slug' => $product->slug]) }}">
                                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <img style="height: 250px;" class="img-fluid w-100" src="{{ asset('admin/images/products/' . $product->image_url) }}" alt="{{ $product->name }}">
                                    </div>
                                </a>
                                <div class="card-body border-left border-right text-left p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3 ml-2">Tên: {{ $product->name }}</h6>
                                    <div class="d-flex justify-content-left">
                                        <h6 class="ml-2">Giá: {{ formatPrice($product->price) }}</h6>
                                        {{-- <h6 class="text-muted ml-2"><del>{{ formatPrice($product->price) }}</del></h6> --}}
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="{{ route('frontend.product.detail', ['slug' => $product->slug]) }}"
                                        class="btn btn-sm text-dark p-0"><i
                                            class="fas fa-eye text-primary mr-1"></i>{{ config('page.btn_view_product') }}</a>
                                    <a href="" class="btn btn-sm text-dark p-0"><i
                                            class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{ $categories_with_product->productWithCategory->links(bladeAsset('components.pagination')) }}
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
    <script>
        $(document).ready(() => {
            $('.custom-control-input').on('click', function(event) {
                var targetRanger = [];
                $('.filter-ranger').not(this).prop('checked', false);
                $(".filter-ranger").each(function() {
                    if ($(this).is(":checked")) {
                        targetRanger.push($(this).attr('id'));
                    }
                });
                $.get("{{ route('frontend.category_filter') }}", {
                    targetRanger: JSON.stringify(targetRanger),
                    slug: "{{ request()->slug }}"
                }, function($data) {
                    $('#product_filter').html($data);
                });
            });
        });
    </script>
