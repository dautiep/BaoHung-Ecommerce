@extends('admin.layouts.app', ['activePage' => 'question.list'])
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
@endsection
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
                                                    <label class="text-capitalize">Tiêu đề câu hỏi <sup
                                                            class="text-danger">*</sup></label>
                                                    <textarea type="text" name="questionName" class="form-control" rows="2">{{ old('questionName') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-capitalize" for="phoneSearch">Dịch vụ <sup
                                                            class="text-danger">*</sup></label>
                                                    <select class="form-control select2" name="questionService"
                                                        id="questionService">
                                                        <option value="">-- Chọn dịch vụ --</option>
                                                        @foreach ($services as $service)
                                                            <option value="{{ $service->id }}"
                                                                {{ old('questionService') == $service->id ? 'selected' : '' }}>
                                                                {{ $service->name }}</option>
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
                                                            <textarea class="textarea summernote" id="detailBlog" name="questionAnswer" placeholder="Nhập nội dung tư vấn"
                                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('questionAnswer') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <p class="mt-5 text-center">
                                                    <label for="attachment">
                                                        <a class="btn btn-primary text-light" role="button"
                                                            aria-disabled="false">+ Chọn file</a>

                                                    </label>
                                                    <input type="file" name="file[]"
                                                        accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, application/*"
                                                        id="attachment" style="visibility: hidden; position: absolute;"
                                                        multiple />

                                                </p>
                                                <p id="files-area">
                                                    <span id="filesList">
                                                        <span id="files-names">

                                                        </span>
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <img id="holder" style="margin-top:15px;max-height:100px;"
                                                    class="img-thumbnail d-none" src="{{ asset('admin/images/file.png') }}">
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
                                        <a href="{{ route('questions.list') }}" class="btn btn-primary ml-4">Trở Về</a>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('questions.store', $question->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Thông Tin Câu Hỏi</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-capitalize">Tiêu đề câu hỏi <sup
                                                            class="text-danger">*</sup></label>
                                                    <textarea type="text" name="questionName" class="form-control" rows="2">{{ $question->question_content }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="text-capitalize" for="phoneSearch">Dịch vụ <sup
                                                            class="text-danger">*</sup></label>
                                                    <select class="form-control select2" name="questionService"
                                                        id="questionService">
                                                        <option value="">-- Chọn dịch vụ --</option>
                                                        @foreach ($services as $service)
                                                            <option value="{{ $service->id }}"
                                                                {{ $question->type_of_service_id == $service->id ? 'selected' : '' }}>
                                                                {{ $service->name }}</option>
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
                                                            <textarea class="textarea summernote" id="detailBlog" name="questionAnswer" placeholder="Nhập nội dung tư vấn"
                                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $question->consulting_content }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">

                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <p class="mt-5 text-center">
                                                    <label for="attachment">
                                                        <a class="btn btn-primary text-light" role="button"
                                                            aria-disabled="false">+ Chọn file</a>

                                                    </label>

                                                    <input type="file" name="file[]"
                                                        accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, application/*"
                                                        id="attachment" style="visibility: hidden; position: absolute;"
                                                        multiple />

                                                </p>
                                                <p id="files-area">
                                                    <span id="filesList">
                                                        <span id="files-names">
                                                            @if (!empty(@$question->attach_files) && is_json(@$question->attach_files))
                                                                @foreach (json_decode(@$question->attach_files) as $item)
                                                                    <span class="file-block"
                                                                        data-url="{{ $item->url }}"><span
                                                                            class="file-delete"><span>+</span></span><span
                                                                            class="name">{{ $item->name }}</span></span>
                                                                @endforeach
                                                            @endif
                                                        </span>
                                                    </span>
                                                    <x-input-control :input="'input'" :control="[
                                                        'for' => 'name',
                                                        'label' => '',
                                                        'type' => 'hidden',
                                                        'class' => 'd-none',
                                                        'id' => 'deleteInput',
                                                        'required' => false,
                                                        'name' => 'file_delete',
                                                        'value' => '[]',
                                                    ]" />
                                                </p>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <img id="holder" style="margin-top:15px;max-height:100px;"
                                                    class="img-thumbnail d-none"
                                                    src="{{ asset('admin/images/file.png') }}">
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
                                        <a href="{{ route('questions.list') }}" class="btn btn-primary ml-4">Trở Về</a>
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
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script id="file_manager" data-route="{{ route('file_manager.file_upload') }}"
        src="{{ asset('plugin/manager-file-summernote/main.js') }}" type="text/javascript"></script>
    <script>
        //select 2
        $('.select2').select2()

        $("#questionService").select2({
            theme: 'bootstrap4'
        });
    </script>
@endsection
