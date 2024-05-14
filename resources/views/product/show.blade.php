@extends('layouts.base')

@section('header.title', __('Store'))

@section('content')
    @foreach($product->attributes as $attribute)
        @include('product.templates.' . $attribute->attributeSet->attributeTemplate->name, ['value' => $attribute->value])
    @endforeach
@endsection
