@extends('admin.layouts.app', ['activePage' => 'questions.list'])

@section('content')
<div class="content">
    <section class="content-header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if (empty($question))
                            <h1 class="m-0">Thêm Câu Hỏi</h1>
                        @else
                            <h1 class="m-0">Cập Nhật Câu Hỏi</h1>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="text-fibo" href="#">Questions</a></li>
                            @if (empty($question))
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
                    @if (empty($question))
                        <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Thông Tin Câu Hỏi</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Tiêu đề câu hỏi <sup class="text-danger">*</sup></label>
                                                <textarea type="text" name="questionName" class="form-control" rows="2">{{ old('questionName') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize" for="phoneSearch">Dịch vụ <sup class="text-danger">*</sup></label>
                                                <select class="form-control select2" name="questionService" id="questionService">
                                                    <option value="">-- Chọn dịch vụ --</option>
                                                    @foreach ($services as $service)
                                                        <option value="{{ $service->id }}" {{ (old('questionService') == $service->id) ? 'selected' : '' }}>{{ $service->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="card card-outline card-info">
                                                <div class="card-header">
                                                <h3 class="card-title text-capitalize">
                                                Nội Dung tư vấn<span class="text-danger">*</span> <br>
                                                </h3>
                                                <!-- tools box -->
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                                                            title="Collapse">
                                                    <i class="fas fa-minus"></i></button>
                                                    <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                                                            title="Remove">
                                                    <i class="fas fa-times"></i></button>
                                                </div>
                                                <!-- /. tools -->
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body ">
                                                <div class="mb-3">
                                                    <textarea class="textarea summernote" id="detailBlog" name="questionAnswer"  placeholder="Nhập nội dung tư vấn"
                                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('questionAnswer') }}</textarea>
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
                                    <a href="{{ route("questions.list") }}" class="btn btn-primary ml-4">Trở Về</a>
                                </div>
                            </div>
                        </form>
                    @else
                        {{-- <form action="{{ route('blog.post.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Thông Tin Bài Viết</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="idPost" id="idPost" value="{{ $post->id }}" hidden>
                                                <label class="text-capitalize">Tên Bài Viết <sup class="text-danger">*</sup></label>
                                                <input type="text" name="namePost" value="{{ $post->name }}" id="namePostEdit" class="form-control" placeholder="Kiến thức liên quan">
                                            </div>
                                            <div class="form-group">
                                                <label class="text-capitalize">Url Bài Viết <sup class="text-danger">*</sup></label>
                                                <input type="text" name="slugPost" value="{{ $post->slug }}" id="slugPostEdit" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="fromTo">Thời gian đăng bài</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="dateTime" class="form-control float-right" value="{{ date_format(date_create($post->posted_at), 'd-m-Y H:i') }}" name="timePost" id="postTimeEdit" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="displayBlog" name="displayPost" {{ ($post->status == App\Enums\EStatusPost::PUBLICED) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="exampleCheck1">Hiển thị bài viết</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fromTo">Mô Tả <sup class="text-danger">*</sup></label>
                                                <div class="card card-outline card-info">
                                                    <textarea class="form-control" id="describeBlog" name="descriptionPost"  placeholder="Nhập mô tả bài viết" rows="5" placeholder="Place some text here"
                                                        style="line-height: 18px;">{!! $post->description !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phoneSearch">Danh Mục <sup class="text-danger">*</sup></label>
                                                <select class="form-control select2" name="categoryPost" id="categoryPost">
                                                    <option value="">-- Chọn danh mục --</option>
                                                    @foreach ($listCategory as $category)
                                                        <option value="{{ $category->id }}" {{ ($post->category_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label>Thẻ <sup class="text-danger">*</sup></label>
                                                    <select name="tagPost[]" id="tagPost" class="select2" multiple="multiple" data-placeholder="Chọn thẻ" style="width: 100%;">
                                                        @php
                                                            $arrTag = [];
                                                            if (!empty($post->tag_id)) {
                                                                if (str_contains($post->tag_id, ';')) {
                                                                    $arrTag = explode(";", $post->tag_id);
                                                                } else {
                                                                    $arrTag[0] = $post->tag_id;
                                                                }
                                                            }
                                                        @endphp
                                                        @foreach ($listTag as $tag)
                                                            <option value="{{ $tag->id }}" {{in_array($tag->id, $arrTag) ? 'selected' : ''}}>{{ $tag->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group w-100">
                                                <label>Ảnh <sup class="text-danger">*</sup></label>
                                                <input class="d-block" type='file' name="imagePost" id="readUrl">
                                                <img style="display: none; height: 180px !important;" class="mt-4 img-fluid" id="uploadedImage" src="#" alt="Uploaded Image" accept="image/png, image/jpeg">
                                                <img style="display: block; height: 180px !important;" class="mt-4 img-fluid" id="uploadedImageOld" src="{{ asset('data/blog/' . $post->image) }}" alt="{{ $post->name }}">
                                            </div>
                                        </div>
                                    </div>

                                    <i class="mt-2">Chú ý: Để anh được load nhanh hơn, quý khách vui lòng tải ảnh có kích thước dưới 5MB. Nếu ảnh có kích thước lớn hơn có thể nén ảnh tại: </i><a href="https://tinypng.com/">https://tinypng.com/</a>
                                    <div class="row mt-3">
                                        <div class="form-group col-md-12">
                                            <div class="card card-outline card-info">
                                                <div class="card-header">
                                                <h3 class="card-title">
                                                Nội Dung <span class="text-danger">*</span> <br>
                                                </h3>
                                                <!-- tools box -->
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                                                            title="Collapse">
                                                    <i class="fas fa-minus"></i></button>
                                                    <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                                                            title="Remove">
                                                    <i class="fas fa-times"></i></button>
                                                </div>
                                                <!-- /. tools -->
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body ">
                                                <div class="mb-3">
                                                    <textarea class="textarea summernote" id="detailBlog" name="contentPost"  placeholder="Nhập nội dung bài viết"
                                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $post->content }}</textarea>
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
                                    <a href="{{ route("blog.category.list") }}" class="btn btn-primary ml-4">Trở Về</a>
                                </div>
                            </div>
                        </form> --}}
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    //select 2
    $('.select2').select2()

    $("#questionService").select2({
        theme: 'bootstrap4'
    });

    //content post
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
            url: "{{ route('questions.upload-image') }}",
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

    setInterval(function(){
        storePost();
   },10000);


    //upload image and preview
    document.getElementById('readUrl').addEventListener('change', function(){
        if (this.files[0] ) {
            const file = this.files[0];
            const  fileType = file['type'];
            const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
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




