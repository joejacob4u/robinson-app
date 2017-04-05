<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='tbl_category';
    //public $incrementing=false;
    // public $timestamps = false;
    protected $fillable=[
    					  'cat_name', 
                          'cat_desc',
                          
    					];
    					
}
