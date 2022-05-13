<?php

namespace App\Http\Controllers;

use App\Classes\Calc\SalaryCalc;
use App\Classes\Taxes\TaxCalc;
use Illuminate\Http\Request;

class CalcController extends Controller
{
    function index() {
        return view('calc_form');
    }

    function calc(Request $request) {
        $salaryCalc = new SalaryCalc($request);
        if($salaryCalc) {
            $taxes = $salaryCalc->getTaxes();
            $itog = $salaryCalc->calcSalary();
            return view("calc_form_res",compact("itog","taxes"));
        }
    }
}
