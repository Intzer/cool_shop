@extends('layouts.base')

@section('content')
    @foreach($products as $product)
        <div class="text-center d-flex align-items-center p-4">
            <h1 class="h3 fw-normal m-auto">SKU: {{ $product->sku }}</h1>
            <h1 class="h3 fw-normal m-auto">Remain: {{ $product->count }}</h1>
        </div>
        <br>
    @endforeach
@endsection
