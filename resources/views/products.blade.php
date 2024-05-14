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
                    @include('inc.product', compact('product'))
                @endforeach
            </div>
        </div>
    </div>
@endsection
