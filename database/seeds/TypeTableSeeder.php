<?php

use Illuminate\Database\Seeder;
use App\types;
class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        types::create([
            'type' => 'Nilai Keterampilan',
        ]);
        types::create([
            'type' => 'Nilai Pengetahuan',
        ]);
    }
}
