<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
      /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
  
    public $timestamps = false;
    protected $fillable = [
        'id_users',
        'name',
        'phone',
        'is_banned',
         'bonus',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_users');
    }
    
    public function Order(){
        return $this->hasMany(Order::class);
    }

    public function is_banned(){
        return $this->is_banned;
    }
}
