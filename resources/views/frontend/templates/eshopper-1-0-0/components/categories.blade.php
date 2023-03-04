  <!-- Categories Start -->
  @if (@$categories_with_product)
      <div class="container-fluid pt-5">
          <div class="row px-xl-5 pb-3">
              @foreach (@$categories_with_product as $category)
                  <div class="col-lg-4 col-md-6 pb-1">
                      <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                          <p class="text-right">{{ $category->productWithCategory->count() }} Sản phẩm</p>
                          <a href="{{ route('frontend.category', ['slug' => $category->slug]) }}"
                              class="cat-img position-relative overflow-hidden mb-3">
                              <img class="img-fluid" src="{{ @$category->productWithCategory[0]->image_url }}"
                                  alt="{{ @$category->description }}">
                          </a>
                          <h5 class="font-weight-semi-bold m-0">{{ $category->name }}</h5>
                      </div>
                  </div>
              @endforeach

          </div>
      </div>
  @endif
  <!-- Categories End -->
