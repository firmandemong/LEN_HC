<?php

namespace Database\Seeders;

use App\Models\Institute;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Institute::create([
            'name'=>'Institute Digital Ekonomi LPKIA'
        ]);

        Institute::create([
            'name'=>'Institute Teknologi Bandung'
        ]);
    }
}
