<?php

use App\User;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\Route;
use App\Jobs\NotifyUserOfCompletedExport;

Route::get('/', function () {
    (new UsersExport)->store('users.xlsx', 'public');

    return 'Su archivo ha sido guardado';
});
