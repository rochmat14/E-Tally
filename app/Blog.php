<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table ='kk_blogs';
    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'id_category',
        'tags',
        'published_on',
        'slug',
        'meta_keyword',
        'meta_description',
        'status',
        'image'
    ];

    public function description()
    {
        return $this->hasMany('App\BlogDescription', 'blog_id');
    }
}
