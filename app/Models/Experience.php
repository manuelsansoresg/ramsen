<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title',
    'slug',
    'subtitle',
    'description',
    'event_date',
    'start_time',
    'end_time',
    'location',
    'includes',
    'price',
    'whatsapp_message',
    'status',
    'is_featured',
    'image',
    'sort_order',
])]
class Experience extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'includes' => 'array',
            'event_date' => 'date',
            'is_featured' => 'boolean',
        ];
    }
}
