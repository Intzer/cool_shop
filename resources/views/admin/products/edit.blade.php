@extends('layouts.admin')

@section('header.title', __('Edit product'))

@section('content')
    <div class="container p-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('Admin panel') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">{{ __('Products') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Edit product') }}</li>
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
                <form action="{{ route('admin.categories.update', $product->id) }}" method="post">
                    @csrf
                    @method('put')
                    <h1 class="h3 mb-3 fw-normal">Edit product</h1>
                    <div class="mb-3">
                        <label for="title" class="m-0">{{ __('Title') }}</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('title') }}" value="{{ $product->info->title }}">
                    </div>

                    <div class="mb-3">
                        <label for="title" class="m-0">{{ __('Price') }}</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="100" value="{{ $product->price }}">
                    </div>

                    <div class="mb-3">
                        <label for="parent">{{ __('Category') }}</label>
                        <select class="form-control" id="parent" name="category_id">
                            @foreach($categories as $category)
                                <option {{ $product->category_id === $category->id ? "selected" : "" }} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary my-2" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.3.1/ckeditor.min.js" integrity="sha512-Qhh+VfoTh+a2tbFw+u86fMKfvyNyHR4aTVbivQAIkFQPcXFa1S0ZlTcib0HXiT4XBVS0a/FtSGamQ9YfXIaPRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush