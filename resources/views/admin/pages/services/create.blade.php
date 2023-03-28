@extends('admin.layouts.app', ['activePage' => 'list-services'])

@section('content')
    <div class="content">
        <section class="content-header">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            @if (empty($service))
                                <h1 class="m-0">Thêm Dịch Vụ</h1>
                            @else
                                <h1 class="m-0">cập Nhật Dịch Vụ</h1>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a class="text-fibo" href="#">Service</a></li>
                                @if (empty($service))
                                    <li class="breadcrumb-item active">Create</li>
                                @else
                                    <li class="breadcrumb-item active">Edit</li>
                                @endif

                            </ol>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if (empty($service))
                            <form action="{{ route('services.save') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Thông Tin Dịch Vụ</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-capitalize">Tên Dịch Vụ <sup
                                                            class="text-danger">*</sup></label>
                                                    <input type="text" name="serviceName"
                                                        value="{{ old('serviceName') }}" class="form-control"
                                                        placeholder="Hướng dẫn mở tài khoản" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-capitalize">Mô Tả Dịch Vụ <sup
                                                            class="text-danger">*</sup></label>
                                                    <textarea type="text" name="serviceDescription" class="form-control" rows="2">{{ old('serviceDescription') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-group w-100">
                                                        <label>Hình Ảnh <sup class="text-danger">*</sup></label>
                                                        <input class="d-block" type='file' name="img_src" id="readUrl">
                                                        <img style="display: none; height: 180px !important; width: 180px !important"
                                                            class="mt-4 img-fluid" id="uploadedImage" src="#"
                                                            alt="Uploaded Image" accept="image/png, image/jpeg">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <span><i>Lưu ý: Các trường có dấu <sup class="text-danger">*</sup> là các
                                                        trường bắt buộc nhập</i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success">Lưu</button>
                                        <a href="{{ route('services.list') }}" class="btn btn-primary ml-4">Trở Về</a>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('services.save', $service->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Thông Tin Dịch Vụ</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-capitalize">Tên Dịch Vụ <sup
                                                            class="text-danger">*</sup></label>
                                                    <input type="text" name="serviceName" value="{{ $service->name }}"
                                                        class="form-control" placeholder="Hướng dẫn mở tài khoản"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-capitalize">Mô tả dịch vụ <sup
                                                            class="text-danger">*</sup></label>
                                                    <textarea type="text" name="serviceDescription" class="form-control" rows="2">{{ $service->description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-group w-100">
                                                        <label>Hình Ảnh <sup class="text-danger">*</sup></label>
                                                        <input class="d-block" type='file' name="img_src"
                                                            id="readUrl">
                                                        <img style="display: none; height: 180px !important; width: 180px !important"
                                                            class="mt-4 img-fluid" id="uploadedImage" src="#"
                                                            alt="Uploaded Image" accept="image/png, image/jpeg">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <span><i>Lưu ý: Các trường có dấu <sup class="text-danger">*</sup> là các
                                                        trường bắt buộc nhập</i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success">Lưu</button>
                                        <a href="{{ route('services.list') }}" class="btn btn-primary ml-4">Trở Về</a>
                                    </div>
                                </div>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        $("#statusBlogCategory").select2({
            theme: 'bootstrap4'
        });

        $(document).ready(() => {
            var imgUrl = `{{ @$service->img_src }}`;
            var targetURL = `{{ asset('/admin/images/services/') }}`;
            if (imgUrl) {
                document.getElementById('uploadedImage').setAttribute('src', `${targetURL}/${imgUrl}`);
                document.getElementById('uploadedImage').style.display = 'block';
            }

            //upload image and preview
            document.getElementById('readUrl').addEventListener('change', function() {
                if (this.files[0]) {
                    const file = this.files[0];
                    const fileType = file['type'];
                    const validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/jpg'];
                    if (!validImageTypes.includes(fileType)) {
                        toastr.error('File không hợp lệ! Vui lòng chọn lại');
                        $('#readUrl').val('')
                    } else {
                        var picture = new FileReader();
                        $("#uploadedImage").css('display', 'none');
                        picture.readAsDataURL(this.files[0]);
                        picture.addEventListener('load', function(event) {
                            document.getElementById('uploadedImage').setAttribute('src', event
                                .target.result);
                            document.getElementById('uploadedImage').style.display = 'block';
                        });
                    }
                }
            });
        })
    </script>
@endsection
