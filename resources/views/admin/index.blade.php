@extends('layouts.admin')

@section('header.title', __('Admin Panel'))

@section('content')
    <div class="container p-4">
        <div class="row">
            <div class="col-12 col-lg-6 offset-lg-3">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">{{ __('Categories Control') }}</a>
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-primary mt-2">{{ __('Customers Control') }}</a>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary mt-2">{{ __('Products Control') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
