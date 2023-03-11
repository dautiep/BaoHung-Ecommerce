@php
    $instanceConfig = app(\App\Http\Controllers\Frontend\SiteConfigController::class);
    $navbars = $instanceConfig->loadConfigurationNavigation();
@endphp
<!-- Footer Start -->
<div class="container-fluid bg-secondary text-dark mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <a href="" class="text-decoration-none">
                <h2 class="mb-4 display-5 font-weight-semi-bold text-info"><span
                        class="text-primary font-weight-bold border border-white px-3 mr-1">{{ config('page.short_title') }}</span>{{ config('page.title') }}
                </h2>
            </a>
            <p>{{ config('page.footer.description') }}</p>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{ config('page.footer.map_market') }}
            </p>
            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{ config('page.footer.email') }}</p>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{ config('page.footer.phone_number') }}
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{ config('page.footer.hotline-1') }}
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{ config('page.footer.hotline-2') }}
            </p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <div class="d-flex flex-column justify-content-start">
                        @foreach ($navbars as $item)
                            <a class="text-dark mb-2" href="{{ @$item['router_page'] }}"><i
                                    class="fa fa-angle-right mr-2"></i>{{ @$item['name_page'] }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-8 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                    <form action="">
                        <div class="form-group">
                            <input type="text" class="form-control border-0 py-4" placeholder="Your Name"
                                required="required" />
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                                required="required" />
                        </div>
                        <div>
                            <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe
                                Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row border-top border-light mx-xl-5 py-4">
        <div class="col-md-6 px-xl-0">
            <p class="mb-md-0 text-center text-md-left text-dark">
                &copy; <a class="text-dark font-weight-semi-bold" href="{{ route('frontend.index') }}">
                    {{ config('page.title') }}</a>
            </p>
        </div>
        <div class="col-md-6 px-xl-0 text-center text-md-right">
            <img class="img-fluid" src="{{ templateAsset('img/payments.png') }}" alt="">
        </div>
    </div>
</div>
<!-- Footer End -->
