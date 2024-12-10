<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        "name",
        "brand",
        "category_id",
        "price",
        "weight",
        "description"
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            set: fn(int $value) => $value * 100,
            get: fn(int $value) => $value / 100
        );
    }
}
