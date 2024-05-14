@extends('layouts.base')

@section('header.title', __('Store'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                @include('inc.sidebar', compact('categories'))
            </div>
            <div class="col-12 col-lg-9">
                @foreach($products as $product)
                    <div class="text-center align-items-center p-4">
                        <div class="h3 fw-normal m-auto">SKU: {{ $product->sku }}</div>
                        <div class="h3 fw-normal m-auto">Remain: {{ $product->count }}</div>
                        <a href="{{ route('products.show', $product->id) }}" class="nav-link px-2 link-dark">{{ __('Show more') }}</a>
                        <hr>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
