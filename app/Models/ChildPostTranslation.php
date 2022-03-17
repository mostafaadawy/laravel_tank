<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildPostTranslation extends Model
{
    use HasFactory;
    protected $table = 'post_translations';
    public $timestamps = false;
    protected $fillable = ['title', 'content'];
}
