@extends('layouts.base')

@section('content')
    @if($errors->any())
        <ul class="list-group list-group-flush">
            @foreach($errors->all() as $error)
                <li class="list-group-item text-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div class="container p-4">
        <div class="row">
            <div class="col-12 col-lg-6">
                <form action="{{ route('categories.store') }}" method="post">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal">Add category</h1>
                    <div class="mb-3">
                        <label for="name" class="m-0">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="mb-3">
                        <label for="parent">Parent category</label>
                        <select class="form-control" id="parent" name="parent">
                            <option value="-1" selected>Not have a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary my-2" type="submit">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection
