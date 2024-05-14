@extends('layouts.admin')

@section('header.title', __('Edit attribute template'))

@section('content')
    <div class="container p-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('Admin panel') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.attributetemplates.index') }}">{{ __('Attribute templates') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Edit attribute template') }}</li>
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
                <form action="{{ route('admin.attributetemplates.update', $attributeTemplate->id) }}" method="post">
                    @csrf
                    @method('put')
                    <h1 class="h3 mb-3 fw-normal">Edit attribute template</h1>
                    <div class="mb-3">
                        <label for="name" class="m-0">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Name') }}" value="{{ $attributeTemplate->name }}">
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