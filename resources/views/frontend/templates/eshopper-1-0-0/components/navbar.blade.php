@php
    $instanceConfig = app(\App\Http\Controllers\Frontend\SiteConfigController::class);
    $navbars = $instanceConfig->loadConfigurationNavigation();
@endphp
<!-- Navbar Start -->
<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                id="navbar-vertical">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown">Dresses <i
                                class="fa fa-angle-down float-right mt-1"></i></a>
                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            <a href="" class="dropdown-item">Men's Dresses</a>
                            <a href="" class="dropdown-item">Women's Dresses</a>
                            <a href="" class="dropdown-item">Baby's Dresses</a>
                        </div>
                    </div>
                    <a href="" class="nav-item nav-link">Shirts</a>
                    <a href="" class="nav-item nav-link">Jeans</a>
                    <a href="" class="nav-item nav-link">Swimwear</a>
                    <a href="" class="nav-item nav-link">Sleepwear</a>
                    <a href="" class="nav-item nav-link">Sportswear</a>
                    <a href="" class="nav-item nav-link">Jumpsuits</a>
                    <a href="" class="nav-item nav-link">Blazers</a>
                    <a href="" class="nav-item nav-link">Jackets</a>
                    <a href="" class="nav-item nav-link">Shoes</a>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        @foreach ($navbars as $item)
                            @if (!empty(@$item['child_page']))
                                <div class="nav-item dropdown">
                                    <a href="#"
                                        class="nav-link dropdown-toggle {{ $instanceConfig->hasActiveRoutePage(@$item['name_router']) }}"
                                        data-toggle="dropdown">{{ @$item['name_page'] }}</a>
                                    <div class="dropdown-menu rounded-0 m-0">
                                        @foreach (@$item['child_page'] as $child)
                                            <a href="{{ @$child['router_page'] }}"
                                                class="dropdown-item {{ $instanceConfig->hasActiveRoutePage(@$item['name_router']) }}">
                                                {{ @$item['name_page'] }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <a href="{{ @$item['router_page'] }}"
                                    class="nav-item nav-link {{ $instanceConfig->hasActiveRoutePage(@$item['name_router']) }}">{{ @$item['name_page'] }}</a>
                            @endif
                        @endforeach

                    </div>
                    <div class="navbar-nav ml-auto py-0">
                        {{-- <a href="" class="nav-item nav-link">Login</a>
                        <a href="" class="nav-item nav-link">Register</a> --}}
                    </div>
                </div>
            </nav>
            @if (@$header_carouel && @$header_carouel['status'] === true)
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($header_carouel['carousel_item'] as $item)
                            <div class="carousel-item {{ @$loop->first == true ? 'active' : '' }}"
                                style="height: 410px;">
                                <img class="img-fluid" src="{{ @$item['img_src'] }}" alt="{{ @$item['img_alt'] }}">
                                <div
                                    class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                    <div class="p-3" style="max-width: 700px;">
                                        <h4 class="text-light text-uppercase font-weight-medium mb-3">
                                            {{ @$item['title'] }}</h4>
                                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">
                                            {{ @$item['description'] }}
                                        </h3>
                                        <a href="{{ @$item['href'] }}"
                                            class="btn btn-light py-2 px-3">{{ @$item['btn_title'] }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- Navbar End -->
