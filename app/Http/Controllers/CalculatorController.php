<?php

namespace App\Http\Controllers;

use App\Calculator\Calculator;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    /**
     * @var Calculator
     */
    private $calculator;

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function calculate(Request $request)
    {
        return [
            'result' => $this->calculator->calculate(
                $request->input('ops'),
                floatval($request->input('n1')),
                floatval($request->input('n2'))
            )
        ];
    }

    public function detail()
    {
        return $this->calculator;
    }
}
