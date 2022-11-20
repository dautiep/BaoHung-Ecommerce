@extends('admin.layouts.app', ['activePage' => 'dashboard'])
@section('title', 'Trang Chủ')
{{-- @php
    $roleUser = Auth::user()->role;
    $isAdmin = ($roleUser == App\Enums\ERole::ADMIN) ? true : false;
@endphp --}}
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">

</section>
@endsection

@section('scripts')

@endsection
