@extends(bladeAsset('layout.layout'))

@section('content')
    @include(bladeAsset('components.page_header'))
    @include(bladeAsset('components.product_detail'))
    @if (@$categories_with_product->productWithCategoryActive->count() > 4)
        @include(bladeAsset('components.silder_product'))
    @else
        @include(bladeAsset('components.product'), ['categories_with_product' => [
            $categories_with_product
        ]])
    @endif
@endsection
