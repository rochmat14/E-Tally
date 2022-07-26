<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class SlideshowDescription extends Model
{
    protected $table ="kk_slideshow_descriptions";
    public $timestamps = false;
    protected $fillable = [
        'slideshow_id','language_id','title', 'subtitle','button_text'
    ];

    public function slideshow()
    {
        return $this->belongsTo('App\Slideshow');
    }
}
