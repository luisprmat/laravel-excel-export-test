<?php

use App\User;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\Route;
use App\Jobs\NotifyUserOfCompletedExport;

Route::get('/', function () {
    $user = User::first(); // Debería ser el usuario autenticado - auth()->user()
    $filePath = asset('storage/users.xlsx');

    (new UsersExport)->store('users.xlsx', 'public')->chain([
        new NotifyUserOfCompletedExport($user, $filePath)
    ]);

    return 'La exportación ha comenzado, te enviaremos un email cuando esté listo.';
});
