<ul>
    @foreach ($categories as $category)
        <li><a href="{{ route('products.index', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
        @if ($category->children->count() > 0)
            @include('inc.categoryChild', ['children' => $category->children])
        @endif
    @endforeach
</ul>