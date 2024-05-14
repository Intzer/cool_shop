@extends('layouts.base')

@section('header.title', __('Store'))

@section('content')
    @if($products->isNotEmpty())
        @foreach($products as $product)
            <div class="text-center d-flex align-items-center p-4">
                <h1 class="h3 fw-normal m-auto">SKU: {{ $product->sku }}</h1>
                <h1 class="h3 fw-normal m-auto">Remain: {{ $product->count }}</h1>
            </div>
        @endforeach
    @else
        <div class="text-center">
            {{ __('There is nothing in the store.') }}
        </div>
    @endif
@endsection
