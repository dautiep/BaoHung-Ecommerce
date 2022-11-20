@extends('admin.layouts.app')

@section('title', 'Login Page')

@section('content')
<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-azoffice">
            <div class="card-header text-center">
                <div><img src="{{ asset('image/logo/logo.png') }}" alt="logo" width="90"></div>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                {!! Form::open(array('route' => 'login.store', 'method' => 'POST')) !!}
                    <div class="input-group mb-3">
                        {!! Form::text('username', null, array('placeholder' => 'Email hoặc Tên Đăng Nhập', 'class' => 'form-control')) !!}
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        {!! Form::password('password', array('placeholder' => 'Mật Khẩu','class' => 'form-control')) !!}
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @if($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif
                    <div class="row">
                        <!-- /.col -->
                        <div class="col">
                            <button type="submit" class="btn btn-azoffice btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                {!! Form::close() !!}
                <div class="row mt-4">
                    <div class="col">
                        <p>©2021 BIDV SYSTEM.</p>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
</body>
@endsection

@section('scripts')
<script src="{{ asset('admin/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
</script>
@endsection
