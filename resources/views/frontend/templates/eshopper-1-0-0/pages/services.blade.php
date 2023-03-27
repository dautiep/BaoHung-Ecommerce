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
                                <img class="img-fluid" src="https://noithatbinhminh.com.vn/wp-content/uploads/2022/12/anh-hoa-mau-don-dep.jpg" alt="">
                            </div>
                            <div class="feature-content">
                                <h5>{{ $service->name }}</h5>
                                <p class="description-service">{{ $service->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
