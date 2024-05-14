<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
            'attribute_template_id' => 'integer',
        ];
    }

    public function attributeTemplate()
    {
        return $this->belongsTo(AttributeTemplate::class);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
