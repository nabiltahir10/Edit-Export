<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExportMain implements WithMultipleSheets
{
    use Exportable;

    private $month;
    
    public function __construct(int $month)
    {
        $this->month = $month;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        
        $sheets[] = new Admin($this->month);
        $sheets[] = new Engineer($this->month);
        $sheets[] = new Thl($this->month);

        return $sheets;
    }
}