<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    
    protected $guarded = [];

   public function section()
   {
   return $this->belongsTo('App\section');
   }
}
