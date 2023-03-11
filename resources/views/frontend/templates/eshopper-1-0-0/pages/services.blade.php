@extends(bladeAsset('layout.layout'))

@section('css')
    <link rel="stylesheet" href="{{ templateAsset('css/services.css') }}">
@endsection
@section('content')
    @include(bladeAsset('components.page_header'))
    <section class="section services-section" id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h2>DỊCH VỤ</h2>
                        <p>Dịch vụ của chúng tôi chuyên nghiệp giúp doanh nghiệp/ tổ chức tập trung vào các chuyên môn cốt lõi, giảm tải công tác quản trị, tối ưu vận hành. Đội ngũ triển khai dịch vụ đạt trình độ cao, dày dạn kinh nghiệm, đạt cam kết chất lượng vượt trội.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- feaure box -->
                @foreach ($services as $service)
                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box-1">
                            <div class="icon">
                                <i class="fa fa-desktop"></i>
                            </div>
                            <div class="feature-content">
                                <h5>{{ $service->name }}</h5>
                                <p class="description-service">{{ $service->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- / -->
                <!-- feaure box -->
                {{-- <div class="col-sm-6 col-lg-4">
                    <div class="feature-box-1">
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="feature-content">
                            <h5>Lorem, ipsum.</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, officiis.</p>
                        </div>
                    </div>
                </div>
                <!-- / -->
                <!-- feaure box -->
                <div class="col-sm-6 col-lg-4">
                    <div class="feature-box-1">
                        <div class="icon">
                            <i class="fa fa-comment"></i>
                        </div>
                        <div class="feature-content">
                            <h5>Lorem, ipsum.</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, officiis.</p>
                        </div>
                    </div>
                </div>
                <!-- / -->
                <!-- feaure box -->
                <div class="col-sm-6 col-lg-4">
                    <div class="feature-box-1">
                        <div class="icon">
                            <i class="fa fa-image"></i>
                        </div>
                        <div class="feature-content">
                            <h5>Lorem, ipsum.</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, officiis.</p>
                        </div>
                    </div>
                </div>
                <!-- / -->
                <!-- feaure box -->
                <div class="col-sm-6 col-lg-4">
                    <div class="feature-box-1">
                        <div class="icon">
                            <i class="fa fa-th"></i>
                        </div>
                        <div class="feature-content">
                            <h5>Lorem, ipsum.</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, officiis.</p>
                        </div>
                    </div>
                </div>
                <!-- / -->
                <!-- feaure box -->
                <div class="col-sm-6 col-lg-4">
                    <div class="feature-box-1">
                        <div class="icon">
                            <i class="fa fa-cog"></i>
                        </div>
                        <div class="feature-content">
                            <h5>Lorem, ipsum.</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, officiis.</p>
                        </div>
                    </div>
                </div> --}}
                <!-- / -->
            </div>
        </div>
    </section>
@endsection
