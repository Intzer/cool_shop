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
            <div class="col-12 col-lg-6">
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

                    <button class="w-100 btn btn-lg btn-primary my-2" type="submit">Save</button>
                </form>
            </div>
            <div class="col-12 col-lg-6">
                <h1 class="h3 mb-3 fw-normal">{{ __('Add attribute set') }}</h1>
                <form method="post" action="{{ route('admin.categories.attachattributeset', $category->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="attribute_set">{{ __('Attribute set') }}</label>
                        <select class="form-control" id="attribute_set" name="attribute_set">
                            @if($attributeSets->isNotEmpty())
                                @foreach($attributeSets as $attributeSet)
                                    <option value="{{ $attributeSet->id }}">{{ $attributeSet->name }}</option>
                                @endforeach
                            @else
                                <option value="-1" selected>No more attribute sets</option>
                            @endif
                        </select>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary my-2" type="submit">Add</button>
                </form>
                <h1 class="h3 mb-3 fw-normal">{{ __('Have attribute sets') }}</h1>
                <form method="post" action="{{ route('admin.categories.detachattributeset', $category->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="attribute_set">{{ __('Attribute set') }}</label>
                        <select class="form-control" id="attribute_set" name="attribute_set">
                            @if($category->attributeSets->isNotEmpty())
                                @foreach($category->attributeSets as $attributeSet)
                                    <option value="{{ $attributeSet->id }}">{{ $attributeSet->name }}</option>
                                @endforeach
                            @else
                                <option value="-1" selected>No more attribute sets</option>
                            @endif
                        </select>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary my-2" type="submit">Remove</button>
            </div>
        </div>
    </div>
@endsection
