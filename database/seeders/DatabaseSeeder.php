<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {



            // $this->call([
            //     CategorySeeder::class,
            //     StatusSeeder::class,
            //     UserSeeder::class,
            // ]);

            $this->call([SupplierSeeder::class]);






    }
}
