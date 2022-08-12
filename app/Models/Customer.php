<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'created_at',
        'updated_at',
    ];

    public function purchases(){
        return $this->hasMany(Purchase::class,'customer_id','id');
    }
}