<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stock;
use App\Models\stockCode;
use App\Models\Category;



class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //Default Category 
        // Category::create(['categoryName' => 'Beaker']);
        // Category::create(['categoryName' => 'Bunsen Burner']);
        // Category::create(['categoryName' => 'Burner Stand']);
        Category::factory(3)->create();
       

        stockCode::create(['category_id' => 1, 'code' => 'B001',  'stockDescription' => 'not necessary']);
        stockCode::create(['category_id' => 1, 'code' => 'B002',  'stockDescription' => 'not necessary']);
        stockCode::create(['category_id' => 2, 'code' => 'BB01',  'stockDescription' => 'not necessary']);
        stockCode::create(['category_id' => 2, 'code' => 'BB02', 'stockDescription' => 'not necessary']);
        stockCode::create(['category_id' => 3, 'code' => 'BS03',  'stockDescription' => 'not necessary']);
        stockCode::create(['category_id' => 3, 'code' => 'BS03',  'stockDescription' => 'not necessary']);

        Stock::create(['category_id' => 1, 'stock_code_id' => 1, 'serialNumber' => 'Beaker001', 'stockAvailability' => true,  'price' => '1', 'warrantyStartDate' => '2023-07-01', 'warrantyEndDate' => '2025-07-01']);
        Stock::create(['category_id' => 1, 'stock_code_id' => 2, 'serialNumber' => 'Beaker002', 'stockAvailability' => true,   'price' => '1', 'warrantyStartDate' => '2023-07-01', 'warrantyEndDate' => '2025-07-01']);
        Stock::create(['category_id' => 2, 'stock_code_id' => 3, 'serialNumber' => 'Bunsen001', 'stockAvailability' => true,   'price' => '1', 'warrantyStartDate' => '2023-07-01', 'warrantyEndDate' => '2025-07-01']);
        Stock::create(['category_id' => 2, 'stock_code_id' => 4, 'serialNumber' => 'Bunsen002', 'stockAvailability' => true,   'price' => '1', 'warrantyStartDate' => '2023-07-01', 'warrantyEndDate' => '2025-07-01']);
        Stock::create(['category_id' => 3, 'stock_code_id' => 5, 'serialNumber' => 'Burner001', 'stockAvailability' => true,   'price' => '1', 'warrantyStartDate' => '2023-07-01', 'warrantyEndDate' => '2025-07-01']);
        Stock::create(['category_id' => 3, 'stock_code_id' => 6, 'serialNumber' => 'Burner002', 'stockAvailability' => true,   'price' => '1', 'warrantyStartDate' => '2023-07-01', 'warrantyEndDate' => '2025-07-01']);
    }
}
