<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

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

    public function category() {
        return $this->belongsTo(ProductCategory::class,'product_category_id');
    }
}
