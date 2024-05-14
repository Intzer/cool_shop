<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function products(): hasMany
    {
        return $this->hasMany(Product::class);
    }

    public function attributeSets(): BelongsToMany
    {
        return $this->BelongsToMany(AttributeSet::class);
    }
}
