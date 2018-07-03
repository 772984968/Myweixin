<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected  $fillable=['title','title_url','explanation','start_time','end_time'];
    public $timestamps = false;
}
