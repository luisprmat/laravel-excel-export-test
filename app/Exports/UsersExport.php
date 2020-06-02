<?php

namespace App\Exports;

use App\User;
use App\Exports\Sheets\UsersPerMonthSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class UsersExport implements WithMultipleSheets
{
    use Exportable;

    private $year;

    public function forYear($year)
    {
        $this->year = $year;

        return $this;
    }

    public function sheets(): array
    {
        return collect(range(1,12))->map(function ($month) {
            return new UsersPerMonthSheet($this->year, $month);
        })->toArray();
    }
}
