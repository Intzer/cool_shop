<div class="d-flex justify-content-center align-items-center">

    <div class="">

    </div>

    <div class="h3 fw-normal m-auto">SKU: {{ $product->sku }}</div>
    <div class="h3 fw-normal m-auto">Remain: {{ $product->count }}</div>
    <a href="{{ route('products.show', $product->id) }}" class="nav-link px-2 link-dark">{{ __('Show more') }}</a>
    <hr>
</div>