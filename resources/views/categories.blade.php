@extends('layouts.base')

@section('header.title', __('Store'))

@section('content')
    @foreach($categories as $category)
        @if(!$category->parent_id && $category->child_count > 0)
            <div class="text-center align-items-center p-4">
                <div class="h3 fw-normal">
                    <a href="{{ route('products.show.category', $category->id) }}" class="px-2">{{ $category->name }}</a> ->
                    @foreach($category->children as $childCategory)
                        <a href="{{ route('categories.show', $childCategory->id) }}" class="px-2">{{ $childCategory->name }}</a>
                    @endforeach
                </div>
            </div>
            <hr>
        @endif
    @endforeach
@endsection
