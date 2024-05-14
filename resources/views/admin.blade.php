@extends('layouts.base')

@section('header.title', __('Admin Panel'))

@section('content')
    <div class="container p-4">

        @if($errors->any())
            <ul class="list-group list-group-flush">
                @foreach($errors->all() as $error)
                    <li class="list-group-item text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="row">
            <div class="col-12 col-lg-6">
                <form action="{{ route('categories.store') }}" method="post">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal">Add category</h1>
                    <div class="mb-3">
                        <label for="name" class="m-0">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
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

            <div class="col-12 col-lg-6">

                @if($categories->isNotEmpty())
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Parent Category') }}</th>
                                <th>{{ __('Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->parent_id }}</td>
                                    <td>
                                        <button class="btn btn-warning"><i class="fa-solid fa-pencil"></i></button>
                                        <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

        </div>
    </div>
@endsection
