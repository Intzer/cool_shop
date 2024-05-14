<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    protected $fillable = [
        'product_id',
        'purchases_count',
        'title',
        'description',
        'image',

        'count',
        'sku',
    ];

    protected function casts(): array
    {
        return [
            'product_id' => 'integer',
            'purchases_count' => 'integer',
            'title' => 'string',
            'description' => 'string',
            'image' => 'string',

            'count' => 'integer',
            'sku' => 'string',
        ];
    }
}
