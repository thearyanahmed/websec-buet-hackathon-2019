<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = ['title','content','status','last_modified_by','user_id'];
}
