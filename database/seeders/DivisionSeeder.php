<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Division::create([
            'name'=>'HC',
            'quota'=> 0,
        ]);

        Division::create([
            'name'=>'Sisfo',
            'quota'=> 0,
        ]);

        Division::create([
            'name'=>'Akuntansi',
            'quota'=> 0,
        ]);
    }
}
