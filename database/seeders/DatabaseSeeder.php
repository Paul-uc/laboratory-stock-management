<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Approval;
use Illuminate\Database\Seeder;
use App\Models\loanStock;
use App\Models\lossStock;
use App\Models\returnStock;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            StockSeeder::class,

        ]);

        loanStock::create(['category_id' => 1, 'stock_code_id' => 1, 'stock_id' => 1, 'user_id' => '2', 'userId' => '2', 'email' => 'example@example.com', 'phoneNumber' => '100000000', 'reason' => 'testing', 'supervisorName' => 'Miss Chin', 'startLoanDate' => '2023-07-01 17:52:58.999999', 'estReturnDate' => '2023-07-11 17:52:58.999999', 'termsAndCondition' => 1]);
        loanStock::create(['category_id' => 1, 'stock_code_id' => 2, 'stock_id' => 2, 'user_id' => '2', 'userId' => '2', 'email' => 'example@example.com', 'phoneNumber' => '100000000', 'reason' => 'testing', 'supervisorName' => 'Miss Chin', 'startLoanDate' => '2023-07-01 17:52:58.999999', 'estReturnDate' => '2023-07-11 17:52:58.999999', 'termsAndCondition' => 1]);
        loanStock::create(['category_id' => 2, 'stock_code_id' => 3, 'stock_id' => 3, 'user_id' => '2', 'userId' => '2', 'email' => 'example@example.com', 'phoneNumber' => '200000000', 'reason' => 'testing2', 'supervisorName' => 'Miss Chin', 'startLoanDate' => '2023-07-01 17:52:58.999999', 'estReturnDate' => '2023-07-12 17:52:58.999999', 'termsAndCondition' => 1]);
        loanStock::create(['category_id' => 2, 'stock_code_id' => 4, 'stock_id' => 4, 'user_id' => '2', 'userId' => '2', 'email' => 'example@example.com', 'phoneNumber' => '200000000', 'reason' => 'testing2', 'supervisorName' => 'Miss Chin', 'startLoanDate' => '2023-07-01 17:52:58.999999', 'estReturnDate' => '2023-09-12 17:52:58.999999', 'termsAndCondition' => 1]);
        loanStock::create(['category_id' => 3, 'stock_code_id' => 5, 'stock_id' => 5, 'user_id' => '2', 'userId' => '2', 'email' => 'example@example.com', 'phoneNumber' => '200000000', 'reason' => 'testing3', 'supervisorName' => 'Miss Chin', 'startLoanDate' => '2023-07-01 17:52:58.999999', 'estReturnDate' => '2023-07-12 17:52:58.999999', 'termsAndCondition' => 1]);
        loanStock::create(['category_id' => 3, 'stock_code_id' => 6, 'stock_id' => 6, 'user_id' => '2', 'userId' => '2', 'email' => 'example@example.com', 'phoneNumber' => '200000000', 'reason' => 'testing3', 'supervisorName' => 'Miss Chin', 'startLoanDate' => '2023-07-01 17:52:58.999999', 'estReturnDate' => '2023-09-12 17:52:58.999999', 'termsAndCondition' => 1]);

        Approval::create(['loan_stock_id' => 1, 'stock_id' => 1, 'userId' => 2, 'status' => 1, 'name' => 'Moderator', 'position' => 'dean', 'remark' => 'testing']);
        Approval::create(['loan_stock_id' => 2, 'stock_id' => 2, 'userId' => 2, 'status' => 1, 'name' => 'Moderator', 'position' => 'dean', 'remark' => 'testing']);
        Approval::create(['loan_stock_id' => 3, 'stock_id' => 3, 'userId' => 2, 'status' => 1, 'name' => 'Moderator', 'position' => 'dean', 'remark' => 'testing']);
        Approval::create(['loan_stock_id' => 4, 'stock_id' => 4, 'userId' => 2, 'status' => 1, 'name' => 'Moderator', 'position' => 'dean', 'remark' => 'testing']);

        returnStock::create(['loan_stock_id' => 1, 'approval_id' => 1, 'stock_id' => 1, 'user_id' => 2, 'penalty' => 20, 'userId' => 2, 'status' => 1, 'name' => 'Moderator', 'position' => 'dean', 'remark' => 'testing', 'created_at' => '2023-07-11 17:52:58.999999']);
        returnStock::create(['loan_stock_id' => 2, 'approval_id' => 2, 'stock_id' => 2, 'user_id' => 2, 'penalty' => 20, 'userId' => 2, 'status' => 1, 'name' => 'Moderator', 'position' => 'dean', 'remark' => 'testing', 'created_at' => '2023-07-11 17:52:58.999999']);

        lossStock::create(['approval_id' => 3, 'stock_id' => 3, 'user_id' => 2, 'status' => 1, 'userId' => 2, 'name' => 'Moderator', 'position' => 'dean', 'remark' => 'testing']);
    }
}
