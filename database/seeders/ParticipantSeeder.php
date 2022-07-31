<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mentor;
use App\Models\Participant;
use Illuminate\Database\Seeder;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user3 = User::create([
            'email'=>'participant@gmail.com',
            'password'=>bcrypt('password'),
            'role'=>'Participant',
        ]);
        Participant::create([
            'participant_code'=>'123456',
            'name'=>'Peserta',
            'school_type'=>'Universitas',
            'school_id'=>1,
            'major_id' => 1,
            'email'=>'participant@gmail.com',
            'file_application_letter'=>'file1.pdf',
            'file_cv'=>'file2.pdf',
            'file_transcript'=>'file3.pdf',
            'division_id'=>1,
            'mentor_id'=>1,
            'start_date'=>'2022-06-06',
            'end_date'=>'2022-07-07',
            'user_id'=>$user3->id,
            'status'=>1,
        ]);

        // Participant::create([
        //     'name'=>'Peserta2',
        //     'school_type'=>'Universitas',
        //     'school_name'=>'LPKIA',
        //     'major' => 'RPL',
        //     'email'=>'robbygystian11@gmail.com',
        //     'file_application_letter'=>'file1.pdf',
        //     'file_cv'=>'file2.pdf',
        //     'file_transcript'=>'file3.pdf',
        // ]);
    }
}
