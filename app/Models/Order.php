<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = [
        'name',
    ];
    public function products()
    {
        return $this->belongsToMany('Product');
    }
}
