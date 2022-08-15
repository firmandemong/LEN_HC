<?php

namespace Database\Seeders;

use App\Models\EvaluationSubject;
use Illuminate\Database\Seeder;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EvaluationSubject::create([
            'subject' => 'Penugasan / Pengetahuan Bidang Kerja',
            'category' => 'Pengetahuan'
        ]);
        EvaluationSubject::create([
            'subject' => 'Kemampuan Memecahkan Masalah',
            'category' => 'Pengetahuan'
        ]);
        EvaluationSubject::create([
            'subject' => 'Keterampilan Teknis',
            'category' => 'Keterampilan'
        ]);
        EvaluationSubject::create([
            'subject' => 'Kualitas / Mutu Hasil Kerja',
            'category' => 'Keterampilan'
        ]);
        EvaluationSubject::create([
            'subject' => 'Ketepatan Waktu Penyelesaian Pekerjaan',
            'category' => 'Keterampilan'
        ]);
        EvaluationSubject::create([
            'subject' => 'Kejujuran',
            'category' => 'Sikap'
        ]);
        EvaluationSubject::create([
            'subject' => 'Kedisiplinan',
            'category' => 'Sikap'
        ]);
        EvaluationSubject::create([
            'subject' => 'Tanggungjawab',
            'category' => 'Sikap'
        ]);
        EvaluationSubject::create([
            'subject' => 'Motivasi',
            'category' => 'Sikap'
        ]);
        EvaluationSubject::create([
            'subject' => 'Inisiatif',
            'category' => 'Sikap'
        ]);
        EvaluationSubject::create([
            'subject' => 'Kerjasama Tim',
            'category' => 'Sikap'
        ]);
        EvaluationSubject::create([
            'subject' => 'Interaksi Sosial',
            'category' => 'Sikap'
        ]);
    }
}
