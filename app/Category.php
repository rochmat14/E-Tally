<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Category extends Model
{
    //
    protected $table = 'kk_category';



    public function get_data(){
        $data = DB::table('kk_category')
        ->select('*')
        ->where('status',1)
        ->orderBy('id','DESC');
        return $data;
    }

}