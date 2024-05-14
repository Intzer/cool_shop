@extends('layouts.admin')

@section('header.title', __('Admin Panel'))

@section('content')
    <div class="container p-4">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('Admin panel') }}</a></li>
                <li class="breadcrumb-item" aria-current="page">{{ __('Attribute Templates') }}</li>
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
                <form action="{{ route('admin.attributetemplates.store') }}" method="post">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal">{{ __('Add attribute template') }}</h1>
                    <div class="mb-3">
                        <label for="name" class="m-0">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>

                    <button class="w-100 btn btn-lg btn-primary my-2" type="submit">{{ __("Add") }}</button>
                </form>
            </div>

            <div class="col-12 col-lg-6">
                <h1 class="h3 mb-3 fw-normal">{{ __("Attribute Templates") }}</h1>
                @if($attributeTemplates->isNotEmpty())
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attributeTemplates as $attributeTemplate)
                                <tr>
                                    <td>{{ $attributeTemplate->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.attributetemplates.edit', $attributeTemplate->id)  }}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                                        <form class="d-inline-block" method="post" action="{{ route('admin.attributetemplates.delete', $attributeTemplate->id) }}">
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
                            @if ($attributeTemplates->currentPage() > 1)
                                <li class="page-item"><a class="page-link" href="{{ route('admin.categories.index', ['page' => $attributeTemplates->currentPage() - 1]) }}">&laquo;</a></li>
                            @endif

                            @for ($i = 1; $i <=$attributeTemplates->lastPage(); $i++)
                                <li class="page-item {{ ($attributeTemplates->currentPage() == $i) ? 'active' : '' }}">
                                    <a class="page-link" href="{{ route('admin.categories.index', ['page' => $i]) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            @if ($attributeTemplates->currentPage() <$attributeTemplates->lastPage())
                                <li class="page-item"><a class="page-link" href="{{ route('admin.categories.index', ['page' => $attributeTemplates->currentPage() + 1]) }}">&raquo;</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
                @else
                    <div class="text-center">
                        {{ __('There is no attribute templates now.') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.3.1/ckeditor.min.js" integrity="sha512-Qhh+VfoTh+a2tbFw+u86fMKfvyNyHR4aTVbivQAIkFQPcXFa1S0ZlTcib0HXiT4XBVS0a/FtSGamQ9YfXIaPRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush