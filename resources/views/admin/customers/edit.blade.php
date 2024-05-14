@extends('layouts.admin')

@section('header.title', __('Edit category'))

@section('content')
    <div class="container p-4">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('Admin panel') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">{{ __('Customers') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Edit customer') }}</li>
            </ol>
        </nav>

        @if($errors->any())
            <ul class="list-group list-group-flush">
                @foreach($errors->all() as $error)
                    <li class="list-group-item text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="row">
            <div class="col-12 col-lg-6 offset-lg-3">
                <form action="{{ route('admin.customers.update', $customer->id) }}" method="post">
                    @csrf
                    @method('put')
                    <h1 class="h3 mb-3 fw-normal">Edit customer</h1>

                    <div class="mb-3">
                        <label class="m-0">ID</label>
                        <input type="text" class="form-control" disabled value="{{ $customer->id }}">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="m-0">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $customer->firstname }}">
                    </div>

                    <button class="w-100 btn btn-lg btn-primary my-2" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
