<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    public function run()
    {
        $userId = 1; // Ganti dengan user_id yang valid di database Anda.

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = [
                'user_id' => $userId,
                'type' => 'income',
                'amount' => rand(100000, 500000),
                'created_at' => now()->startOfYear()->addMonths($i - 1),
                'updated_at' => now()->startOfYear()->addMonths($i - 1),
            ];
            $data[] = [
                'user_id' => $userId,
                'type' => 'expense',
                'amount' => rand(50000, 300000),
                'created_at' => now()->startOfYear()->addMonths($i - 1),
                'updated_at' => now()->startOfYear()->addMonths($i - 1),
            ];
        }

        DB::table('reports')->insert($data);
    }
}
