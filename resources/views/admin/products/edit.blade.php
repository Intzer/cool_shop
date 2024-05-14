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
            <div class="col-12 col-lg-6">
                <h1 class="h3 mb-3 fw-normal">Edit product</h1>
                <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="title" class="m-0">{{ __('Title') }}</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('title') }}" value="{{ $product->info->title }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="m-0">{{ __('Description') }}</label>
                        <textarea id="description" name="description" style="display: none;"></textarea>
                        <script>
                            window.onload = function() {
                                ClassicEditor.create(document.querySelector('#description'))
                                    .then(editor => {
                                        editor.setData('{!! $product->info->description !!}');
                                    })
                                    .catch( error => {
                                        console.error(error);
                                    });
                            };
                        </script>
                    </div>

                    <div>
                        <img width="40%" src="{{ $product->info->image == null ? asset('storage/files/images/none.jpg') : asset('storage/files/images/'.$product->info->image) }}" alt="Image">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="m-0">{{ __('Image') }}</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>

                    <div class="mb-3">
                        <label for="title" class="m-0">{{ __('Price') }}</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="100" value="{{ $product->price->price }}">
                    </div>

                    <button class="w-100 btn btn-lg btn-primary my-2" type="submit">Save</button>
                </form>
            </div>
            <div class="col-12 col-lg-6">
                <h1 class="h3 mb-3 fw-normal">{{ __('Add to category') }}</h1>
                <form class="mb-3" method="post" action="{{ route('admin.products.tocategory', $product->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="category">{{ __('Category') }}</label>
                        <select class="form-control" id="category" name="category">
                            @if($categories->isNotEmpty())
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @else
                                <option value="-1" selected>No more categories</option>
                            @endif
                        </select>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary my-2" type="submit">Add</button>
                </form>

                <h1 class="h3 mb-3 fw-normal">{{ __('Now in category') }}</h1>
                <form class="mb-3" method="post" action="{{ route('admin.products.fromcategory', $product->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="category">{{ __('Category') }}</label>
                        <select class="form-control" id="category" name="category">
                            @if($product->categories->isNotEmpty())
                                @foreach($product->categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @else
                                <option value="-1" selected>No more categories</option>
                            @endif
                        </select>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary my-2" type="submit">Remove</button>
                </form>

                <h1 class="h3 mb-3 fw-normal">{{ __('Fill attributes of categories') }}</h1>
                <form method="post" action="{{ route('admin.products.fillattributes', $product->id) }}">
                    @csrf

                    @foreach($attributeSets as $attributeSet)
                        <div class="mb-3">
                            <label for="attributeSet{{ $attributeSet->id }}">{{ $attributeSet->name }}</label>

                            @if ($attributes->isNotEmpty() && $attributes->contains('id', $attributeSet->id))
                                <input id="attributeSet{{ $attributeSet->id }}" type="text" class="form-control" placeholder="Your value" value="{{ $attributes->where('id', $attributeSet->id)->first()->value }}">
                            @else
                                <input id="attributeSet{{ $attributeSet->id }}" type="text" class="form-control" placeholder="Your value" value="">
                            @endif

                        </div>
                    @endforeach

                    <button class="w-100 btn btn-lg btn-primary my-2" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.3.1/ckeditor.min.js" integrity="sha512-Qhh+VfoTh+a2tbFw+u86fMKfvyNyHR4aTVbivQAIkFQPcXFa1S0ZlTcib0HXiT4XBVS0a/FtSGamQ9YfXIaPRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush