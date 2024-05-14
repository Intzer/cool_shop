<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPrice extends Model
{
    protected $fillable = [
        'product_id',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'product_id' => 'integer',
            'price' => 'decimal',
        ];
    }

    public function product(): BelongsTo
    {
    return $this->belongsTo(Product::class, 'id', 'product_id');
    }
}
