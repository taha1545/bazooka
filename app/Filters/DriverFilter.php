<?php 

namespace App\Filters;

use Illuminate\Http\Request;

class DriverFilter extends apifilter
{
    protected $safeParms = [
        'name' => ['eq'],
        'phone' => ['eq'],
        'online' => ['eq'],
        'charge' => ['eq'],
    ];  

    protected $columnMap = [
        'online' => 'is_online',
        'charge' =>'is_charge',
    ];   

    protected $operatorMap = [
        'eq' => '=', 
    ];  
}