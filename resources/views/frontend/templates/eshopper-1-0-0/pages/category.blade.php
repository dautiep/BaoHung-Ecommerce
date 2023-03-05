@extends(bladeAsset('layout.layout'))

@section('content')
    @include(bladeAsset('components.page_header'))
    <div id='product_filter'>
        @include(bladeAsset('components.product_category'))
    </div>

@endsection

