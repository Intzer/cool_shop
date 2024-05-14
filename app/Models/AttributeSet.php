<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AttributeSet extends Model
{
    protected $fillable = [
        'name',
        'attribute_template_id'
    ];

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'attribute_template_id' => 'integer'
        ];
    }

    public function attributeTemplate(): BelongsTo
    {
        return $this->belongsTo(AttributeTemplate::class);
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
