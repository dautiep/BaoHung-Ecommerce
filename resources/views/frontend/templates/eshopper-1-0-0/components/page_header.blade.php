    <!-- Page Header Start -->
    @if (@$header_setting)
        <div class="container-fluid bg-secondary mb-5">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
                <h1 class="font-weight-semi-bold text-uppercase mb-3">{{ @$header_setting['page_name'] }}</h1>
                <div class="d-inline-flex">
                    @foreach (@$header_setting['bread_crumbs'] as $item)
                        @if (!$loop->last)
                            <p class="m-0"><a href="{{ $item['router_page'] }}">{{ $item['name_page'] }}</a></p>
                            <p class="m-0 px-2">-</p>
                        @else
                            <p class="m-0">{{ $item['name_page'] }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Page Header End -->
