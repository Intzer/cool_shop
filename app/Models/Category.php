<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
            'parent_id' => 'integer',
            'child_count' => 'integer',
        ];
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
