<div class="card p-3">
    <div class="row">
        <div class="col-12 col-md-4">
            <a href="{{ route('products.show', $product->id) }}">
                <div class="display-item-16-9">
                    <img src="{{ $product->info->image == null ? asset('storage/files/images/none.jpg') : asset('storage/files/images/'.$product->info->image) }}" alt="image">
                </div>
            </a>
        </div>

        <div class="col-12 col-md-8 d-flex flex-column">
            <div>
                <a class="text-decoration-none text-dark" href="{{ route('products.show', $product->id) }}">
                    <b>{{ $product->info->title }}</b>
                </a>
            </div>
            <div>
                {{ $product->info->description }}
            </div>
            <div>
                <span class="badge bg-success"> {{ $product->price->price }} Byn</span>
            </div>
        </div>
    </div>
</div>