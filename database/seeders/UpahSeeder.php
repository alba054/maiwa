<?php

namespace Database\Seeders;

use App\Models\Upah;
use Illuminate\Database\Seeder;

class UpahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $upahs = collect([
            ['status' => 1, 'detail' => 'Periksa Kebuntingan', 'price' => '5000'],
            ['status' => 2, 'detail' => 'Performa (Recording)', 'price' => '5000'],
            ['status' => 3, 'detail' => 'Insiminasi Buatan', 'price' => '5000'],
            ['status' => 4, 'detail' => 'Perlakuan Kesehatan', 'price' => '5000'],
        ]);
        $upahs->each(function($upah){
            Upah::create([
                'status' => $upah['status'],
                'detail' => $upah['detail'],
                'price' => $upah['price'],
            ]);
        });
       
    }
}
