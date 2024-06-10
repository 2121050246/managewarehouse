<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $statuses = [
            ['name' => 'Đang hoạt động'],
            ['name' => 'Đã ngưng hoạt động'],
        ];
       Status::factory()->createMany($statuses);
    }
}
