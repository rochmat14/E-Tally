<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageDescription extends Model
{
    protected $table ="kk_page_descriptions";
    public $timestamps = false;
    protected $fillable = [
        'page_id', 'language_id', 'name', 'description'
    ];

    public function page()
    {
        return $this->belongsTo('App\Page');
    }
}
