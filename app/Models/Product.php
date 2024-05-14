<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
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

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
