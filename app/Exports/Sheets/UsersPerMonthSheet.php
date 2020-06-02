<?php

namespace App\Exports\Sheets;

use App\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;

class UsersPerMonthSheet implements FromQuery, WithTitle
{
    private $year;
    private $month;

    public function __construct($year, $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    public function query()
    {
        return User::query()
            ->whereYear('created_at', $this->year)
            ->whereMonth('created_at', $this->month)
        ;
    }

    public function title(): string
    {
        return Carbon::parse("{$this->year}-{$this->month}-01")->translatedFormat('F-Y');
    }
}
