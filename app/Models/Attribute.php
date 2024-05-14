<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Attribute extends Model
{
    protected $fillable = [
        'value',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'string',
        ];
    }

    public function attributeSet()
    {
        return $this->belongsTo(AttributeSet::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
