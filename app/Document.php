<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
     protected $table='tbl_document';
    //public $incrementing=false;
    // public $timestamps = false;
    protected $fillable=[
    					            'doc_name', 
                          'doc_author',
                          'cat_id',
                          'publish_date',
                          'doc_cover'
    					];



    public function category()
    {
        return $this->belongsTo('App\Category', 'cat_id','id');
    }

 }
