<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    public $fillable = [
        'product_category_id',
        'slug',
        'name',
        'price',
        'discount_price',
        'short_desscription',
        'qty',
        'shipping',
        'weight',
        'description',
        'information',
        'image_url',
        'status'
    ];
}
