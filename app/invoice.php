<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoice extends Model

{
    protected $guarded=[''];



    public function section()
    {
    return $this->belongsTo('App\section');
    }

    use SoftDeletes;

}
