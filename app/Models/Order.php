<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $hidden = [];

    protected $fillable = [
        'id_customer',
        'id_driver',
        'is_cook' ,
        'is_finish' ,
        'location_lat' ,
        'location_long',
    ];
    
    public $timestamps = false;

    public function foods()
    {
    return $this->belongsToMany(Food::class, 'order_food')
                ->withPivot('number');
    }
    public function customer() {
        return $this->belongsTo(Customer::class,'id_customer');
    }
    public function Driver(){
        return $this->belongsTo(Driver::class,'id_driver');
    }
}
