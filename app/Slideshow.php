<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    protected $table ="kk_slideshows";
    protected $guarded = [
        'id'
    ];

    public function description()
    {
        return $this->hasMany('App\SlideshowDescription', 'slideshow_id');
    }
}
