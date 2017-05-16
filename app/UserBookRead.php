<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBookRead extends Model
{
    protected $table = 'users_book_read';
    protected $fillable = ['user_id','book_id','page_no','status','processed'];
}
