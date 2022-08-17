<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $task_1 = Task::create([
            'title' => "Membuat laporan",
            'description' => "Melakukan filter data dari data data excel yang diberikan",
            'participant_id' => 1,
            'created_id' => 2,
        ]);

        $task_1 = Task::create([
            'title' => "Mengkoding FE",
            'description' => "Membuat kodingan halaman dashboad dan login",
            'participant_id' => 2,
            'created_id' => 2,
        ]);
    }
}
