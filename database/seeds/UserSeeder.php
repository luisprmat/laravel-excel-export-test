<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Luis Parrado',
            'email' => 'luisprmat@gmail.com',
            'created_at' => now()
        ]);

        factory(User::class, 14)->create();
    }
}
