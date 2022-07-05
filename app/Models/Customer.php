<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function purchases(){
        return $this->hasMany(Purchase::class,'customer_id','id');
    }
}