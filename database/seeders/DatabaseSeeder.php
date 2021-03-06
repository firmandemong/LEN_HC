<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Mentor;
use App\Models\Participant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DivisionSeeder::class);
        $this->call(MentorSeeder::class);
        $this->call(ParticipantSeeder::class);
    }
}
