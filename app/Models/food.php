<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class food extends Model
{
     /** @use HasFactory<\Database\Factories\FoodFactory> */
     use HasFactory;

     protected $fillable = [
        'name',
        'type',
        'description',
         'price',
         'evrg_time',
    ];
     
     public $timestamps = false;
    
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_food');
    }


    public function foodFiles()
    {
        return $this->hasMany(FoodFile::class); 
    }

}
