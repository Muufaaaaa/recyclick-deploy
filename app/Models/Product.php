<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'eco_badge',
        'eco_points_reward',
        'eco_impact',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}