@extends('layouts.admin')

@section('header.title', __('Admin Panel'))

@section('content')
    <div class="container p-4">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('Admin panel') }}</a></li>
                <li class="breadcrumb-item" aria-current="page">{{ __('Categories') }}</li>
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
                <form action="{{ route('categories.store') }}" method="post">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal">{{ __('Add category') }}</h1>
                    <div class="mb-3">
                        <label for="name" class="m-0">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>

                    <div class="mb-3">
                        <label for="parent">{{ __('Parent category') }}</label>
                        <select class="form-control" id="parent" name="parent">
                            <option value="-1" selected>{{ __("Do not have a parent") }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary my-2" type="submit">{{ __("Add") }}</button>
                </form>
            </div>

            <div class="col-12 col-lg-6">
                <h1 class="h3 mb-3 fw-normal">{{ __("Categories") }}</h1>
                @if($categories->isNotEmpty())
                <div class="table-responsive">
                    <table class="table text-center">
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
                                    <td>{{ $category->parent === null ? "-" : $category->parent->name }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category->id)  }}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                                        <form class="d-inline-block" method="post" action="{{ route('categories.delete', $category->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination justify-content-center">
                            @if ($categories->currentPage() > 1)
                                <li class="page-item"><a class="page-link" href="{{ route('admin.index', ['page' => $categories->currentPage() - 1]) }}">&laquo;</a></li>
                            @endif

                            @for ($i = 1; $i <= $categories->lastPage(); $i++)
                                <li class="page-item {{ ($categories->currentPage() == $i) ? 'active' : '' }}">
                                    <a class="page-link" href="{{ route('admin.index', ['page' => $i]) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            @if ($categories->currentPage() < $categories->lastPage())
                                <li class="page-item"><a class="page-link" href="{{ route('admin.index', ['page' => $categories->currentPage() + 1]) }}">&raquo;</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
                @else
                    <div class="text-center">
                        {{ __('There is no categories now.') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
