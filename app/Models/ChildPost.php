<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildPost extends Post
{
    protected $table = 'posts';
    protected $translationForeignKey = 'post_id';
}
