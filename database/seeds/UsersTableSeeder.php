<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'login' => 'root',
            'name' => 'Mikhail Garmashov',
            'email' => 'mikhail.garmashov@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('moscow'),
            'role' => 'admin'
        ]);

        factory(User::class)->create([
            'login' => 'jon',
            'name' => 'Jon Fisher',
            'password' => \Illuminate\Support\Facades\Hash::make('jon'),
            'role' => 'admin'
        ]);
    }
}
