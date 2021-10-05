<?php

namespace Database\Seeders;

use App\Models\Desa;
use Illuminate\Database\Seeder;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $desas = collect([
            ['kecamatan_id' => 1, 'name' => 'Libureng'],
            ['kecamatan_id' => 1, 'name' => 'Mattirowalie'],
            ['kecamatan_id' => 2, 'name' => 'Tanete'],
            ['kecamatan_id' => 2, 'name' => 'Pao-Pao'],
            ['kecamatan_id' => 3, 'name' => 'Raja'],
            ['kecamatan_id' => 3, 'name' => 'Tarasu'],
            ['kecamatan_id' => 4, 'name' => 'Mattampa Bulu'],
            ['kecamatan_id' => 4, 'name' => 'Mattampa Walie'],
            ['kecamatan_id' => 5, 'name' => 'Batu-Batu'],
            ['kecamatan_id' => 5, 'name' => 'Bulue'],
            ['kecamatan_id' => 6, 'name' => 'Gattareng'],
            ['kecamatan_id' => 6, 'name' => 'Gattareng Toa'],
            ['kecamatan_id' => 7, 'name' => 'Sudiang'],
            ['kecamatan_id' => 7, 'name' => 'Daya'],
            ['kecamatan_id' => 8, 'name' => 'Tamalanrea Indah'],
            ['kecamatan_id' => 8, 'name' => 'Tamalanrea Jaya'],
            
            
        ]);

        $desas->each(function($desa){
            Desa::create([
                'name' => $desa['name'],
                'kecamatan_id' => $desa['kecamatan_id'],
            ]);
        });
    }
}
