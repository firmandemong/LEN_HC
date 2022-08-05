<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mentor;
use Illuminate\Database\Seeder;

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email'=>'hc@gmail.com',
            'password'=>bcrypt('password'),
            'role'=>'HC',
        ]);
        Mentor::create([
            'name'=>'HC',
            'no_hp'=>'089626317662',
            'gedung'=>'gedung A',
            'lantai' => '4',
            'division_id'=>1,
            'user_id'=>$user->id,
        ]);

        $user3 = User::create([
            'email'=>'190613011.1mi2.robbygustian@gmail.com',
            'password'=>bcrypt('password'),
            'role'=>'Mentor',
        ]);
        Mentor::create([
            'name'=>'Bob Mentor',
            'no_hp'=>'089626317662',
            'gedung'=>'gedung A',
            'lantai' => '4',
            'division_id'=>1,
            'user_id'=>$user3->id,
        ]);
    }
}
