<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class UsersExport implements FromQuery, ShouldQueue
{
    use Exportable;

    private $date;

    public function forDate($date)
    {
        $this->date = $date;

        return $this;
    }


    /**
    * @return \Illuminate\Database\Query\Builder
    */
    public function query()
    {
        return User::query();
    }
}
