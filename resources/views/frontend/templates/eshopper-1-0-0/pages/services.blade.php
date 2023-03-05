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
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, rerum. Deleniti, molestias
                            et quam illum facere ea quod enim eos temporibus ut totam. Culpa, provident obcaecati? Labore
                            ipsa quae doloribus.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- feaure box -->
                <div class="col-sm-6 col-lg-4">
                    <div class="feature-box-1">
                        <div class="icon">
                            <i class="fa fa-desktop"></i>
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
                </div>
                <!-- / -->
            </div>
        </div>
    </section>
@endsection
