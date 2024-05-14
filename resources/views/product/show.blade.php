@extends('layouts.base')

@section('header.title', __('Store'))

@section('content')
    @foreach($product->attributes as $attribute)
        @include('product.templates.' . $attribute->attributeSet->attributeTemplate->name, ['value' => $attribute->value])
    @endforeach

    <div class="text-center align-items-center p-4">
        <div class="h3 fw-normal m-auto">Price: {{ $product->price->price }}</div>
    </div>
@endsection
