@extends('layouts.base')

@section('header.title', __('Store'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if($orders->isNotEmpty())
                    @foreach($orders as $order)
                        @include('inc.order', $order)
                    @endforeach
                @else
                    <div class="text-center">
                        {{ __('There is no orders yet.') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
