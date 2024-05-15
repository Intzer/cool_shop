@extends('layouts.base')

@section('header.title', __('Store'))

@section('content')
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-12 col-lg-8">
                <div class="card pt-3 px-3">
                    <div class="mb-2">
                        <b>{{ $product->info->title }}</b>
                    </div>
                    <div class="mb-2 w-75">
                        <div class="display-item-16-9">
                            <img src="{{ $product->info->image == null ? asset('storage/files/images/none.jpg') : asset('storage/files/images/'.$product->info->image) }}" alt="image">
                        </div>
                    </div>
                    <div class="mb-2">
                        {!! $product->info->description !!}
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tbody>
                            @foreach($product->attributes as $attribute)
                                @include('product.templates.'.$attribute->attributeSet->attributeTemplate->name, ['name' => $attribute->attributeSet->name, 'value' => $attribute->value])
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 ps-5">
                <div class="card py-3 px-3">
                    <div class="text-center mb-2">
                        <h3>{{ __('Buy this product') }}</h3>
                    </div>
                    <div>
                            @auth
                                @if (auth()->user()->orders->isNotEmpty() && auth()->user()->orders->contains('id', $product->id))
                                    {{ __('You are own it!') }}
                                    <a href="{{ $product->info->url }}" target="_blank" class="btn btn-success w-100">{{ __('Download') }}</a>
                                @else
                                    <form action="{{ route('products.buy', $product->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-success w-100">{{ $product->price->price }} {{ __('Byn') }}</button>
                                    </form>
                               @endif
                            @endauth

                            @guest
                                <div class="text-center">
                                    Please, <a href="{{ route('login.index') }}">login</a> to your account to buy it!
                                </div>
                            @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
