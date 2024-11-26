<?php 

namespace App\Filters;

use Illuminate\Http\Request;

class foodfilter extends apifilter
{
    protected $safeParms = [
        'id'=> ['eq'],
        'name' => ['eq'],
        'type' => ['eq'],
        'description' => ['eq'],
        'price' => ['eq','bt','lt'],
        'averagetime' => ['eq','bt','lt'],
    ];  

    protected $columnMap = [
        'averagetime' => 'evrg_time',
    ];   

    protected $operatorMap = [
        'eq' => '=', 
        'bt'=>'>',
        'lt'=>'<',
    ];  
}