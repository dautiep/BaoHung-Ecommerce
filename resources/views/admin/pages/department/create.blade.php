@extends('admin.layouts.app', ['activePage' => 'department.list'])

@section('content')
    <div class="content">
        <section class="content-header">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <x-title-page :title="$title" :class="'m-0'" />
                        </div>
                        <div class="col-sm-6">
                            <x-breadcrumb />
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('department.store', ['id' => request()->id]) }}" method="POST">
                            @csrf
                            <div class="card card-success">
                                <div class="card-header">
                                    <x-title-page :title="$title" :class="'card-title'" />
                                </div>

                                <div class="card-body">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <x-input-control :input="'input'" :control="[
                                                'for' => 'name',
                                                'label' => 'Tên phòng ban',
                                                'type' => 'text',
                                                'class' => '',
                                                'required' => true,
                                                'name' => 'name',
                                                'value' => @$data->name,
                                                'placeholder' => 'Nhập tên phòng ban',
                                            ]" />
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
                                    <a href="{{ route('department.list') }}" class="btn btn-primary ml-4">Trở Về</a>
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
