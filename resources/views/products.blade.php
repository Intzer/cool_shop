@extends('layouts.base')

@section('header.title', __('Store'))

@section('content')
    @if($products->isNotEmpty())
        @foreach($products as $product)
            <div class="text-center align-items-center p-4">
                <div class="h3 fw-normal m-auto">SKU: {{ $product->sku }}</div>
                <div class="h3 fw-normal m-auto">Remain: {{ $product->count }}</div>
                <a href="{{ route('products.show', $product->id) }}" class="nav-link px-2 link-dark">{{ __('Show more') }}</a>
                <hr>
            </div>
        @endforeach
    @else
        <div class="text-center">
            {{ __('There is nothing in the store.') }}
        </div>
    @endif
@endsection
