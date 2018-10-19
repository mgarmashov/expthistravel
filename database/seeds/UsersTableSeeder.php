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
            'name' => 'Root',
            'email' => 'mikhail.garmashov@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('moscow')
        ]);
    }
}
