<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mentor;
use App\Models\Participant;
use App\Models\Certificate;
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
        $user = User::create([
            'email'=>'participant1@gmail.com',
            'password'=>bcrypt('password'),
            'role'=>'Participant',
        ]);
        $participant1 = Participant::create([
            'participant_code'=>'123456',
            'name'=>'Peserta 1',
            'school_type'=>'Universitas',
            'school_id'=>1,
            'major_id' => 3,
            'email'=>'participant1@gmail.com',
            'file_application_letter'=>'file1.pdf',
            'file_cv'=>'file2.pdf',
            'file_transcript'=>'file3.pdf',
            'division_id'=>1,
            'mentor_id'=>2,
            'start_date'=>'2022-06-06',
            'end_date'=>'2022-07-07',
            'user_id'=>$user->id,
            'status'=>4,
        ]);

        // cert
        $cert_1 = Certificate::create([
            'participant_id' => $participant1->id,
            'file' => 'file1.pdf',
            'uploaded_at' => '2022-08-08',
        ]);

        $user2 = User::create([
            'email'=>'participant2@gmail.com',
            'password'=>bcrypt('password'),
            'role'=>'Participant',
        ]);
        Participant::create([
            'participant_code'=>'123456',
            'name'=>'Peserta 2',
            'school_type'=>'Universitas',
            'school_id'=>1,
            'major_id' => 3,
            'email'=>'participant2@gmail.com',
            'file_application_letter'=>'file1.pdf',
            'file_cv'=>'file2.pdf',
            'file_transcript'=>'file3.pdf',
            'division_id'=>1,
            'mentor_id'=>2,
            'start_date'=>'2022-06-06',
            'end_date'=>'2022-07-07',
            'user_id'=>$user2->id,
            'status'=>4,
        ]);

        $user3 = User::create([
            'email'=>'participant3@gmail.com',
            'password'=>bcrypt('password'),
            'role'=>'Participant',
        ]);
        Participant::create([
            'participant_code'=>'123456',
            'name'=>'Peserta',
            'school_type'=>'Universitas',
            'school_id'=>1,
            'major_id' => 1,
            'email'=>'participant3@gmail.com',
            'file_application_letter'=>'file1.pdf',
            'file_cv'=>'file2.pdf',
            'file_transcript'=>'file3.pdf',
            'mentor_id'=>1,
            'start_date'=>'2022-06-06',
            'end_date'=>'2022-07-07',
            'user_id'=>$user3->id,
            'status'=>0,
        ]);

        $user4 = User::create([
            'email'=>'participant4@gmail.com',
            'password'=>bcrypt('password'),
            'role'=>'Participant',
        ]);
        Participant::create([
            'participant_code'=>'123456',
            'name'=>'Peserta',
            'school_type'=>'Universitas',
            'school_id'=>1,
            'major_id' => 1,
            'email'=>'participant4@gmail.com',
            'file_application_letter'=>'file1.pdf',
            'file_cv'=>'file2.pdf',
            'file_transcript'=>'file3.pdf',
            'division_id'=>2,
            'mentor_id'=>1,
            'start_date'=>'2022-06-06',
            'end_date'=>'2022-07-07',
            'user_id'=>$user4->id,
            'status'=>2,
        ]);

        $user5 = User::create([
            'email'=>'participant5@gmail.com',
            'password'=>bcrypt('password'),
            'role'=>'Participant',
        ]);
        Participant::create([
            'participant_code'=>'123456',
            'name'=>'Peserta',
            'school_type'=>'Universitas',
            'school_id'=>1,
            'major_id' => 1,
            'email'=>'participant5@gmail.com',
            'file_application_letter'=>'file1.pdf',
            'file_cv'=>'file2.pdf',
            'file_transcript'=>'file3.pdf',
            'division_id'=>1,
            'mentor_id'=>1,
            'start_date'=>'2022-06-06',
            'end_date'=>'2022-07-07',
            'user_id'=>$user5->id,
            'status'=>2,
        ]);

        $user6 = User::create([
            'email'=>'participant6@gmail.com',
            'password'=>bcrypt('password'),
            'role'=>'Participant',
        ]);
        Participant::create([
            'participant_code'=>'123456',
            'name'=>'Peserta',
            'school_type'=>'Universitas',
            'school_id'=>1,
            'major_id' => 3,
            'email'=>'participant6@gmail.com',
            'file_application_letter'=>'file1.pdf',
            'file_cv'=>'file2.pdf',
            'file_transcript'=>'file3.pdf',
            'division_id'=>1,
            'mentor_id'=>1,
            'start_date'=>'2022-06-06',
            'end_date'=>'2022-07-07',
            'user_id'=>$user6->id,
            'status'=>2,
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
