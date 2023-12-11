<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CommisionPercentageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('commission_percentages')->insert([
            'parent_level' => '1',
            'commission_percentage' => '5',
        ]);

        DB::table('commission_percentages')->insert([
            'parent_level' => '2',
            'commission_percentage' => '3',
        ]);

        DB::table('commission_percentages')->insert([
            'parent_level' => '3',
            'commission_percentage' => '1',
        ]);

    }
}
