<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//A measured amount (or an amount that can potentially be measured).
class Quantity extends Model
{
    public function Collection()
    {
    	return $this->hasMany('App\Models\Quantity');
    }
}
