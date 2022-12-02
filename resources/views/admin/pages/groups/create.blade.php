@extends('admin.layouts.app', ['activePage' => 'groups.create'])

@section('content')
    <div class="content">
        <section class="content-header">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            @if (empty(request()->id))
                                <h1 class="m-0">Thêm nhóm quyền</h1>
                            @else
                                <h1 class="m-0">Cập Nhật nhóm quyền</h1>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a class="text-fibo" href="#">Service</a></li>
                                @if (empty(request()->id))
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
                        <form action="{{ route('groups.store', ['id' => request()->id]) }}" method="POST">
                            @csrf
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Thông Tin nhóm quyền</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Tên nhóm quyền <sup
                                                        class="text-danger">*</sup></label>
                                                <input type="text" name="name" value="{{ old('name', @$data->name) }}"
                                                    class="form-control" placeholder="Tên nhóm quyền" autocomplete="offgit ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Chọn phân quyền <sup
                                                        class="text-danger">*</sup></label>
                                                <select name="roles[]" id="roles" class="select2" multiple="multiple"
                                                    data-placeholder="Chọn thẻ" style="width: 100%;">
                                                    <option value="">--- Chọn phân quyền ---</option>
                                                    @foreach ($roles as $item)
                                                        <option value="{{ @$item->id }}"
                                                            {{ in_array($item->id, old('roles', @$data->roles ? @$data->roles->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                                                            {{ @$item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-capitalize">Trạng Thái <sup
                                                        class="text-danger">*</sup></label>
                                                <select class="form-control select2" name="status" id="status">
                                                    <option value="">--- Chọn Trạng thái ---</option>
                                                    @foreach (config('global.default.status.groups') as $value)
                                                        <option value="{{ @$value['key'] }}"
                                                            {{ @$value['key'] == @$data->status || $value['key'] == old('status', @$data->status) ? 'selected' : '' }}>
                                                            {{ @$value['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <span><i>Lưu ý: Các trường có dấu <sup class="text-danger">*</sup> là các
                                                    trường bắt buộc nhập</i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Lưu</button>
                                    <a href="{{ route('groups.list') }}" class="btn btn-primary ml-4">Trở Về</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        $("#roles").select2({
            theme: 'bootstrap4'
        });
    </script>
@endsection
