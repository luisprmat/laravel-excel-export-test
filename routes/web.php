<?php

use App\Exports\UsersExport;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    (new UsersExport)->forYear(2020)->store('users.xlsx', 'public');

    return 'Laravel Excel';
});
