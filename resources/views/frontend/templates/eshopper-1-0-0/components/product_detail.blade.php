    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100"
                                src="{{ asset('admin/images/products/' . @$product_detail->image_url) }}" alt="Image">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ @$product_detail->name }}</h3>
                <h3 class="font-weight-semi-bold mb-4">{{ formatPrice(@$product_detail->price) }}</h3>
                <p class="mb-4">{{ @$product_detail->description }}</p>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Miêu tả</h4>
                        <div class="container">
                            {!! html_entity_decode($product_detail->content) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
