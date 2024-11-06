<?php 

namespace App\Filters;

use Illuminate\Http\Request;

class Customerfilter extends apifilter
{
    protected $safeParms = [
        'name' => ['eq'],
        'phone' => ['eq'],
        'bonus' => ['eq'],
        'isbanned' => ['eq'],
    ];  

    protected $columnMap = [
        'isbanned' => 'is_banned',
    ];   

    protected $operatorMap = [
        'eq' => '=', 
    ];  
}
