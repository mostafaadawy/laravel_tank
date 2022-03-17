<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Translatable;
    use HasFactory;
    protected $fillable = [
        'lineItemId', 'category_id', 'brand_id', 'image', 'unit', 'final_price', 'old_price', 'available', 'quantity_discount', 'min_quantity', 'max_quantity', 'interval', 'deleted_by'
    ];

    public function orders()
    {
        return $this->belongsToMany('Order');
    }
}
