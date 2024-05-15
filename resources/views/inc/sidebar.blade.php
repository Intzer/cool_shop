<div class="card">
        <div class="card-header pt-3">
                <h4>{{ __('Categories') }}</h4>
        </div>
        <div class="card-body">
                <ul class="list-unstyled">
                    @foreach ($categories as $category)
                        <li><a class="text-decoration-none link" href="{{ route('products.index', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
                        @if ($category->children->count() > 0)
                            @include('inc.categoryChild', ['children' => $category->children])
                        @endif
                    @endforeach
                </ul>
        </div>
</div>
