<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
     /** @use HasFactory<\Database\Factories\DriverFactory> */
     use HasFactory;

     protected $fillable = [
        'id_users',
        'name',
        'phone',
        'is_online',
         'is_charge',
    ];
  
     public $timestamps = false;

     public function user(){
        return $this->belongsTo(User::class, 'id_users');
    }
    
    public function Order(){
        return $this->hasMany(Order::class);
    }

    public function is_charge(){
        return $this->is_charge;
    }
    public function is_online(){
        return $this->is_online;
    }

}
