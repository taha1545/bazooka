<?php

namespace App\Filters;

use Illuminate\Http\Request;

class Orderfilter extends ApiFilter
{
    protected $safeParams = [
        'id' => ['eq'],
        'customer' => ['eq', 'bt', 'lt'],
        'driver' => ['eq', 'bt', 'lt'],
        'iscook' => ['eq'],
        'isfinish' => ['eq'],
        'Latitude' => ['eq', 'bt', 'lt'],
        'Longitude' => ['eq', 'bt', 'lt'],
        'foods' => ['eq'],
    ];

    protected $columnMap = [
        'iscook' => 'is_cook',
        'isfinish' => 'is_finish',
        'Latitude' => 'location_lat',
        'Longitude' => 'location_long',
        'customer' => 'id_customer',
        'driver' => 'id_driver',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'bt' => '>',
        'lt' => '<',
    ];

    public function transform(Request $request)
    {
        $query = [];

        foreach ($this->safeParams as $param => $operators) {
            $value = $request->query($param);

            if (isset($value)) {
                $column = $this->columnMap[$param] ?? $param;
                $operator = $this->operatorMap['eq'];

                if (is_array($value)) {
                    foreach ($operators as $op) {
                        if (isset($value[$op])) {
                            $operator = $this->operatorMap[$op];
                            $query[] = [$column, $operator, $value[$op]];
                        }
                    }
                } else {
                    $query[] = [$column, $operator, $value];
                }
            }
        }

        return $query;
    }
}

