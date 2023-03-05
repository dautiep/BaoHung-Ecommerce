@extends(bladeAsset('layout.layout'))

@section('content')
    @include(bladeAsset('components.featured'))
    @include(bladeAsset('components.categories'))
    {{-- @include(bladeAsset('components.offer')) --}}
    @include(bladeAsset('components.product'))
    {{-- @include(bladeAsset('components.subscribe')) --}}
    {{-- @include(bladeAsset('components.vendor')) --}}
@endsection
