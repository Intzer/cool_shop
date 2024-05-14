<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    protected $fillable = [
        'name',
        'parent_id',
        'child_count',
    ];

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'child_count' => 'integer',
        ];
    }

    public function parent(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
