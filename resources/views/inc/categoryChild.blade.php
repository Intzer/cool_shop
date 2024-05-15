<ul>
    @foreach ($children as $child)
        <li><a class="text-decoration-none text-dark" href="{{ route('products.index', ['category' => $child->id]) }}">{{ $child->name }}</a></li>
        @if ($child->children->count() > 0)
            @include('inc.categoryChild', ['children' => $child->children])
        @endif
    @endforeach
</ul>