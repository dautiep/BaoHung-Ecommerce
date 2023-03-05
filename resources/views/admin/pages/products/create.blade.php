@extends('admin.layouts.app', ['activePage' => 'list-products'])

@section('content')
<div class="content">
    <section class="content-header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if (empty($product))
                            <h1 class="m-0">Thêm Sản Phẩm</h1>
                        @else
                            <h1 class="m-0">cập Nhật Sản Phẩm</h1>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="text-fibo" href="#">Product</a></li>
                            @if (empty($product))
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
                    @if (empty($product))
                        <form action="{{ route('products.save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Thông Tin Sản Phẩm</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Tên Sản Phẩm <sup class="text-danger">*</sup></label>
                                                <input type="text" name="productName" value="{{ old('productName') }}" class="form-control" placeholder="Sản phẩm..." autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="phoneSearch">Danh Mục Sản Phẩm <sup class="text-danger">*</sup></label>
                                                <select class="form-control select2" name="productCategory" id="productCategory">
                                                    <option value="">Chọn Danh Mục</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ (old('productCategory') == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Mô Tả Sản Phẩm <sup
                                                        class="text-danger">*</sup></label>
                                                <textarea type="text" name="productDescription" class="form-control" rows="2">{{ old('productDescription') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Giá Sản Phẩm <sup class="text-danger">*</sup></label>
                                                <input type="number" name="productPrice" value="{{ old('productPrice') }}" class="form-control" placeholder="" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-group w-100">
                                                    <label>Hình Ảnh Sản Phẩm <sup class="text-danger">*</sup></label>
                                                    <input class="d-block" type='file' name="productImage" id="readUrl">
                                                    <img style="display: none; height: 180px !important;" class="mt-4 img-fluid" id="uploadedImage" src="#" alt="Uploaded Image" accept="image/png, image/jpeg">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-mt-2">
                                        <div class="col-md-12">
                                            <div class="card card-outline card-info">
                                                <div class="card-header">
                                                    <label class="card-title text-capitalize">
                                                        Nội Dung Chi Tiết
                                                    </label>
                                                    <!-- tools box -->
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool btn-sm"
                                                            data-card-widget="collapse" data-toggle="tooltip"
                                                            title="Collapse">
                                                            <i class="fas fa-minus"></i></button>
                                                        <button type="button" class="btn btn-tool btn-sm"
                                                            data-card-widget="remove" data-toggle="tooltip"
                                                            title="Remove">
                                                            <i class="fas fa-times"></i></button>
                                                    </div>
                                                    <!-- /. tools -->
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body ">
                                                    <div class="mb-3">
                                                        <textarea class="textarea summernote" id="detailBlog" name="productContent" placeholder="Nhập nội dung chi tiết"
                                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('productContent') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <span><i>Lưu ý: Các trường có dấu <sup class="text-danger">*</sup> là các trường bắt buộc nhập</i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Lưu</button>
                                    <a href="{{ route("products.list") }}" class="btn btn-primary ml-4">Trở Về</a>
                                </div>
                            </div>
                        </form>
                    @else
                    <form action="{{ route('products.save', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Thông Tin Sản Phẩm</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-capitalize">Tên Sản Phẩm <sup class="text-danger">*</sup></label>
                                            <input type="text" name="productName" value="{{ $product->name }}" class="form-control" placeholder="Sản Phẩm..." autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="phoneSearch">Danh Mục Sản Phẩm <sup class="text-danger">*</sup></label>
                                            <select class="form-control select2" name="productCategory" id="productCategory">
                                                <option value="">Chọn Danh Mục</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ ($product->category_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-capitalize">Mô Tả Sản Phẩm <sup
                                                    class="text-danger">*</sup></label>
                                            <textarea type="text" name="productDescription" class="form-control" rows="2">{{ $product->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-capitalize">Giá Sản Phẩm <sup class="text-danger">*</sup></label>
                                            <input type="number" name="productPrice" value="{{ $product->price }}" class="form-control" placeholder="" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-group w-100">
                                                <label>Hình Ảnh Sản Phẩm <sup class="text-danger">*</sup></label>
                                                <input class="d-block" type='file' name="productImage" id="readUrl">
                                                <img style="height: 180px !important;" class="mt-4 img-fluid" id="uploadedImageOld" src="{{ asset('admin/images/products/' .'/'. $product->image_url) }}" alt="{{ $product->name }}" accept="image/png, image/jpeg, image/jpg">
                                                <img style="display: none; height: 180px !important;" class="mt-4 img-fluid" id="uploadedImage" src="#" alt="Uploaded Image" accept="image/png, image/jpeg, image/jpg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-mt-2">
                                    <div class="col-md-12">
                                        <div class="card card-outline card-info">
                                            <div class="card-header">
                                                <label class="card-title text-capitalize">
                                                    Nội Dung Chi Tiết
                                                </label>
                                                <!-- tools box -->
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool btn-sm"
                                                        data-card-widget="collapse" data-toggle="tooltip"
                                                        title="Collapse">
                                                        <i class="fas fa-minus"></i></button>
                                                    <button type="button" class="btn btn-tool btn-sm"
                                                        data-card-widget="remove" data-toggle="tooltip"
                                                        title="Remove">
                                                        <i class="fas fa-times"></i></button>
                                                </div>
                                                <!-- /. tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body ">
                                                <div class="mb-3">
                                                    <textarea class="textarea summernote" id="detailBlog" name="productContent" placeholder="Nhập nội dung chi tiết"
                                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $product->content }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <span><i>Lưu ý: Các trường có dấu <sup class="text-danger">*</sup> là các trường bắt buộc nhập</i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Lưu</button>
                                <a href="{{ route("products.list") }}" class="btn btn-primary ml-4">Trở Về</a>
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
        //select2
        $("#productCategory").select2({
                theme: 'bootstrap4'
        });

        //summernote
        $(document).ready(function() {
            $('.summernote').summernote({
                callbacks: {
                    onImageUpload: function(image) {
                        uploadImage(image[0]);
                    }
                },
                toolbar: [
                    ['style', ['style']],
                    ['fontsize', ['fontsize']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']]
                ],
                popover: {
                    image: [
                        ['custom', ['imageAttributes']],
                        ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                },
                lang: 'en-US', // Change to your chosen language
                imageAttributes:{
                    icon:'<i class="note-icon-pencil"/>',
                    removeEmpty:false, // true = remove attributes | false = leave empty if present
                    disableUpload: false // true = don't display Upload Options | Display Upload Options
                }
            });
        });

    function uploadImage(image) {
        data = new FormData();
        data.append("file", image);
        $('.loader').show();
        $.ajax({
            data: data,
            type: "POST",
            url: "{{ route('products.upload-image') }}",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                $('.loader').hide();
                var image = $('<img>').attr('src', response.url);
                $('.summernote').summernote("insertNode", image[0]);
            }
        });
    }

        //upload image and preview
        document.getElementById('readUrl').addEventListener('change', function(){
            if (this.files[0] ) {
                const file = this.files[0];
                const  fileType = file['type'];
                const validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/jpg'];
                if (!validImageTypes.includes(fileType)) {
                    toastr.error('File không hợp lệ! Vui lòng chọn lại');
                    $('#readUrl').val('')
                } else {
                    var picture = new FileReader();
                    $("#uploadedImageOld").css('display', 'none');
                    picture.readAsDataURL(this.files[0]);
                    picture.addEventListener('load', function(event) {
                        document.getElementById('uploadedImage').setAttribute('src', event.target.result);
                        document.getElementById('uploadedImage').style.display = 'block';
                    });
                }
            }
        });
    </script>
@endsection




