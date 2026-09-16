<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'photo',
        'button_text',
        'button_link',
        'sort_order',
        'status'
    ];
}
