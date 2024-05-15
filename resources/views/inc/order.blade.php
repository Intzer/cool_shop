<div class="card">
    <div class="card-header">
    {{ __('Date of bought') }}: {{ $order->created_at }}
</div>
<div class="card-body">
<div>
    <a class="text-decoration-none text-dark" href="{{ route('products.show', $order->product->id) }}"><b>{{ $order->product->info->title }}</b></a>
</div>
<div>
    <a href="{{ $order->product->info->url }}" target="_blank">Download</a>
</div>
</div>
</div>