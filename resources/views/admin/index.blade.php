@extends('layouts.admin')

@section('header.title', __('Admin Panel'))

@section('content')
    <div class="container p-4">
        <div class="row">
            <div class="col-12 col-lg-4 offset-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Admin panel</h3>
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-info text-center"><a class="text-dark" href="{{ route('admin.categories.index') }}">{{ __('Categories Control') }}</a></li>
                            <li class="list-group-item list-group-item-info text-center"><a class="text-dark" href="{{ route('admin.customers.index') }}">{{ __('Customers Control') }}</a></li>
                            <li class="list-group-item list-group-item-info text-center"><a class="text-dark" href="{{ route('admin.products.index') }}">{{ __('Products Control') }}</a></li>
                            <li class="list-group-item list-group-item-info text-center"><a class="text-dark" href="{{ route('admin.attributesets.index') }}">{{ __('Attribute Sets Control') }}</a></li>
                            <li class="list-group-item list-group-item-info text-center"><a class="text-dark" href="{{ route('admin.attributetemplates.index') }}">{{ __('Attribute Templates Control') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
