<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Major::create([
            'name'=>'Informatika'
        ]);

        Major::create([
            'name'=>'Administrasi'
        ]);
    }
}
