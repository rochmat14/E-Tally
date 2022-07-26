<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table ='kk_blogs';
    protected $guarded = [
        'id'
    ];

    public function description()
    {
        return $this->hasMany('App\BlogDescription', 'blog_id');
    }
}
