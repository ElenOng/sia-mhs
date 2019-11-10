<?php

use Illuminate\Database\Seeder;
use App\Roles;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::create([
            'role' => 'Siswa',
        ]);
        Roles::create([
            'role' => 'Guru',
        ]);
        Roles::create([
            'role' => 'Administrator',
        ]);
    }
}
