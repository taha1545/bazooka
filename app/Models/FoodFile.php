<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\FoodFileFactory;

class FoodFile extends Model
{
    use HasFactory;  protected $fillable = [
        'food_id',
        'path',
        'type',
        'name',
    ];



    public $timestamps = false;

    protected static function newFactory()
    {
        return FoodFileFactory::new();
    }

    public function food()
{
    return $this->belongsTo(Food::class, 'food_id');
}

}
