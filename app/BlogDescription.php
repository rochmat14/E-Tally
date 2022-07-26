<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogDescription extends Model
{
    protected $table ='kk_blog_descriptions';
    public $timestamps = false;
    protected $fillable = [
        'blog_id','language_id','title', 'description'
    ];

    public function blog()
    {
        return $this->belongsTo('App\Blog');
    }
}
