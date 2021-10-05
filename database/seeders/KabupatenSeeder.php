<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use Illuminate\Database\Seeder;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kabupatens = collect([
            'Kabupaten Barru',
            'Kabupaten Bone',
            'Kabupaten Soppeng',
            'Kota Makassar'
        ]);
        $kabupatens->each(function($kabupaten){
            Kabupaten::create([
                'name' => $kabupaten,
            ]);
        });
        
    }
}
