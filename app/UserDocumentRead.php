<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDocumentRead extends Model
{
  protected $table = 'users_document_read';
  protected $fillable = ['user_id','document_id','doc_page_id','page_no','status','processed'];

  public function user()
  {
    return $this->belongsTo('App\User','user_id');
  }

  public function document()
  {
    return $this->belongsTo('App\Document','document_id');
  }

  public function page()
  {
    return $this->belongsTo('App\DocumentPages','doc_page_id');
  }

}
