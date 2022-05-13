<?php
namespace App\Classes\Taxes;

class TaxCalc {

    const opv_percentage = 0.1;
    const vosms_percentage = 0.02;
    const osms_percentage = 0.02;
    const co_percentage = 0.035;
    const mzp = 60000;
    const mrp = 3180;
    const correct_on = 25; //Срабатывание корректировки
    private $salary;
    private $opv;
    private $vosms;
    private $osms;
    private $co;
    private $ipn;

    private $hasVichet;

    public function __construct($salary,$hasVichet) {
        $this->hasVichet = $hasVichet;
        $this->salary = $salary;
        $this->opv = $this->calcOPV($salary);
        $this->vosms = $this->calcVOSMS($salary);
        $this->osms = $this->calcOSMS($salary);
        $this->co = $this->calcСО($salary);
        $this->ipn = $this->calcIPN($salary);
    }

    public function getTaxesArray() {
        $taxes["opv"] = $this->opv;
        $taxes["vosms"] = $this->vosms;
        $taxes["osms"] = $this->osms;
        $taxes["co"] = $this->co;
        $taxes["ipn"] = $this->ipn;
        return $taxes;
    }

    public function calcOPV($salary)
    {
        $opv = $salary * self::opv_percentage;
        return $opv;
    }

    public function calcVOSMS($salary) {
        $vosms = $salary * self::vosms_percentage;
        return $vosms;
    }

    public function calcOSMS($salary) {
        $osms = $salary * self::osms_percentage;
        return $osms;
    }

    public function calcСО($salary) {
        $co = ($salary - $this->opv) * self::co_percentage;
        return $co;
    }

    public function calcIPN($salary) {
        $opv = $this->opv;
        $vosms = $this->vosms;
        $ipn = $salary - $opv - $vosms;

        if($this->hasVichet) {
            $ipn = $ipn - self::mzp; //Возможно в будущем будет не 1мзп а другое значение
        }
        if($salary < self::correct_on*self::mrp) {
            $correct = ($salary - $opv - $vosms) * 0.9; //ВОМСМ в условии думаю это восмс
            if($this->hasVichet) {
                $correct = $correct - self::mzp; //Возможно в будущем будет не 1мзп а другое значение
            }
            $ipn = $ipn - $correct;
        }
        $ipn = $ipn*0.1;
        return $ipn;
    }
}
