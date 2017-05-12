<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorys extends Model
{
    use SoftDeletes;
    //
    protected $table='categorys';

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];
}
