<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageLayout extends Model
{
    protected $fillable = [
        'page_id',
        'type',
        'section_id',
        'title',
        'description',
        'data',
        'sort_order',
        'status'
    ];

    protected $casts = [
        'data' => 'array'
    ];
}

