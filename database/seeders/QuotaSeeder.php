<?php

namespace Database\Seeders;

use App\Models\DetailDivisionQuota;
use Illuminate\Database\Seeder;

class QuotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DetailDivisionQuota::create([
            'major_id'=>1,
            'division_id'=>1,
            'quota'=>1
        ]);

        DetailDivisionQuota::create([
            'major_id'=>1,
            'division_id'=>2,
            'quota'=>2
        ]);
    }
}
