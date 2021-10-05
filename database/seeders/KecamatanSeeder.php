<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kecamatans = collect([
            ['kabupaten_id' => 1, 'name' => 'Tanete Riaja'],
            ['kabupaten_id' => 1, 'name' => 'Tanete Rilau'],
            ['kabupaten_id' => 2, 'name' => 'Kajuara'],
            ['kabupaten_id' => 2, 'name' => 'Lamuru'],
            ['kabupaten_id' => 3, 'name' => 'Marioriawa'],
            ['kabupaten_id' => 3, 'name' => 'Marioriwawo'],
            ['kabupaten_id' => 4, 'name' => 'Biringkanaya'],
            ['kabupaten_id' => 4, 'name' => 'Tamalanrea'],
            
        ]);

        $kecamatans->each(function($kecamatan){
            Kecamatan::create([
                'name' => $kecamatan['name'],
                'kabupaten_id' => $kecamatan['kabupaten_id'],
            ]);
        });
    }
}
