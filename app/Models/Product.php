<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{

    protected function casts(): array
    {
        return [
            'id' => 'integer',
        ];
    }
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function info(): HasOne
    {
        return $this->hasOne(ProductInfo::class, 'product_id', 'id');
    }

    public function price(): HasOne
    {
        return $this->hasOne(ProductPrice::class, 'product_id', 'id');
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class);
    }
}
