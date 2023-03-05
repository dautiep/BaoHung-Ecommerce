@extends(bladeAsset('layout.layout'))
@section('content')
    @php
        $instanceConfig = app(\App\Http\Controllers\Frontend\PageController::class);
        $navbars = $instanceConfig->error404();
    @endphp
    @include(bladeAsset('components.page_header'))
@endsection
