<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentPages extends Model
{
    protected $table='tbl_document_pages';
    //public $incrementing=false;
    // public $timestamps = false;
    protected $fillable=[
    					  'doc_page_no',
                          'doc_page_content',
                          'doc_id',
                          'tags'
    					];


 public function document()
    {
        return $this->belongsTo('App\Document', 'doc_id','id');
    }


}
