<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'customer_id',
    ];

    protected function casts(): array
    {
        return [
            'customser_id' => 'integer',
        ];
    }
}
