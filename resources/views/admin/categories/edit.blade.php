@extends('layouts.admin')

@section('header.title', __('Edit category'))

@section('content')
    <div class="container p-4">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('Admin panel') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">{{ __('Categories') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Edit category') }}</li>
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
                <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
                    @csrf
                    @method('put')
                    <h1 class="h3 mb-3 fw-normal">Edit category</h1>
                    <div class="mb-3">
                        <label for="name" class="m-0">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $category->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="parent">Parent category</label>
                        <select class="form-control" id="parent" name="parent">
                            <option value="-1" {{ $category->parent_id === null ? "selected" : "" }}>Not have a category</option>
                            @foreach($categories as $entry)
                                @if($entry->id == $category->id)
                                    @continue
                                @endif

                                <option {{ $category->parent_id === $entry->id ? "selected" : "" }} value="{{ $entry->id }}">{{ $entry->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Attributes...</label>
                        Soon....
                    </div>

                    <button class="w-100 btn btn-lg btn-primary my-2" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
