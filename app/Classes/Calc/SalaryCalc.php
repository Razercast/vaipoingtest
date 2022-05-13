<?php
namespace App\Classes\Calc;

use App\Classes\Taxes\TaxCalc;
use Illuminate\Http\Request;

class SalaryCalc
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        $validated = $request->validate([
            'salary' => 'required|integer',
            'workdays' => 'required|integer',
            'defaultdays' => 'required|integer',
        ]);
        if(!$validated) {
            return false;
        } else {
            return true;
        }
    }

    function calcSalary() {
        $request = $this->request;
        $salary = intval($request->salary);
        $hasvichet = boolval($request->hasvichet);

        $taxes = $this->getTaxes();

        $default_days = $request->defaultdays;
        $work_days = $request->workdays;
        $isretired = $request->isretired;
        $invalid = $request->invalid;

        //ЗП
        $itog = $salary * ($work_days/$default_days);
        if($invalid && $isretired) {
            //Нету доп налога
        } elseif($isretired) {
            $itog = $itog - $taxes["ipn"];
        } elseif($invalid) {
            if($invalid==1 || $invalid==2) {
                $itog = $itog - $taxes["co"];
            } elseif($invalid==3) {
                $itog = $itog - $taxes["opv"] - $taxes["co"];
            }
            if($salary > TaxCalc::mzp*882) {
                $itog = $itog - $taxes["ipn"];
            }
        } else {
            //Для всех остальных
            $itog = $itog - $taxes["ipn"] - $taxes["opv"] - $taxes["vosms"] - $taxes["osms"] - $taxes["co"];
        }

        return $itog;

    }
    function getTaxes() {
        $request = $this->request;
        $salary = intval($request->salary);
        $hasvichet = boolval($request->hasvichet);

        $taxCalc = new TaxCalc($salary,$hasvichet);
        $taxes = $taxCalc->getTaxesArray();
        return $taxes;
    }
}
