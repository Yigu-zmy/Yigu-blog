<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
//    use SoftDeletes;
    //
    protected $table = 'articles';

    protected $fillable = ['userid','title','content','updated_at','category'];

    protected $dates = ['deleted_at'];
}
