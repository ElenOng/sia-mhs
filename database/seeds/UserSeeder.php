<?php

use Illuminate\Database\Seeder;
use App\Users;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Users::create([
            'userstable_id' => null,
            'userstable_type' => null,
            'username' => 'SU',
            'roles_id' => 3,
            'password' => Hash::make('123',['rounds' => 12]),
            'statuses_id' => 1,
        ]);
    }
}
