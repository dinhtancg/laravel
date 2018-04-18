<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Article extends Model
{
    const PAGINATE_LIMIT = 5;
    protected $fillable = [
        'category_id',
        'title',
        'content',
        'slug',
        'user_id',
        'confirmed',
        'published',
        'reject_flag'
    ];

}
