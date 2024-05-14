@extends('layouts.admin')

@section('header.title', __('Admin Panel'))

@section('content')
    <div class="container p-4">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('Admin panel') }}</a></li>
                <li class="breadcrumb-item" aria-current="page">{{ __('Customers') }}</li>
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
                <h1 class="h3 mb-3 fw-normal">{{ __("Customers") }}</h1>
                @if($customers->isNotEmpty())
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->firstname }}</td>
                                    <td>
                                        <a href="{{ route('admin.customers.edit', $customer->id)  }}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                                        <form class="d-inline-block" method="post" action="{{ route('admin.customers.delete', $customer->id) }}">
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
                            @if ($customers->currentPage() > 1)
                                <li class="page-item"><a class="page-link" href="{{ route('admin.customers.index', ['page' => $customers->currentPage() - 1]) }}">&laquo;</a></li>
                            @endif

                            @for ($i = 1; $i <= $customers->lastPage(); $i++)
                                <li class="page-item {{ ($customers->currentPage() == $i) ? 'active' : '' }}">
                                    <a class="page-link" href="{{ route('admin.customers.index', ['page' => $i]) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            @if ($customers->currentPage() < $customers->lastPage())
                                <li class="page-item"><a class="page-link" href="{{ route('admin.customers.index', ['page' => $customers->currentPage() + 1]) }}">&raquo;</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
                @else
                    <div class="text-center">
                        {{ __('There is no customers now.') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
