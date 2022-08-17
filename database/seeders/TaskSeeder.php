<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\TaskFileSubmission;

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
            'status' => 1,
        ]);

        $file_submission_1 = TaskFileSubmission::create([
            'file' => 'file1.pdf',
            'task_id' => $task_1->id
        ]);

        $task_1 = Task::create([
            'title' => "Mengkoding FE",
            'description' => "Membuat kodingan halaman dashboad dan login",
            'participant_id' => 2,
            'created_id' => 2,
        ]);
    }
}
