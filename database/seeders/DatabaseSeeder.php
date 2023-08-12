<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Approval;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Category;
use App\Models\loanStock;
use App\Models\returnStock;
use App\Models\Stock;
use App\Models\stockCode;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user1 = User::factory()->create([
            'name' => 'SuperAdmin',
            'username' => 'superadmin',
            'email' => 'superadmin@admin.com',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
        ]);

        $user3 = User::factory()->create([
            'name' => 'Default User',
            'username' => 'default user',
            'email' => 'default@example.com',
        ]);
        
        //Default Category 
        Category::create(['name' => 'Beaker']);
        Category::create(['name' => 'Bunsen Burner']);

        stockCode::create(['category_id' => 1 , 'code' => 'B001']);
        stockCode::create(['category_id' => 1 , 'code' => 'B002']);
        stockCode::create(['category_id' => 2 , 'code' => 'BB01']);
        stockCode::create(['category_id' => 2 , 'code' => 'BB02']);

        Stock::create(['category_id' => 1 ,'stock_code_id' => 1, 'serialNumber' => 'Beaker001', 'stockAvailability'=> true, 'stockQuantity'=> 1, 'stockDescription'=> '', 'price' => '1', 'warrantyStartDate' => '', 'warrantyEndDate' => '']);
        Stock::create(['category_id' => 1 ,'stock_code_id' => 2, 'serialNumber' => 'Beaker002', 'stockAvailability'=> true, 'stockQuantity'=> 1, 'stockDescription'=> '', 'price' => '1', 'warrantyStartDate' => '', 'warrantyEndDate' => '']);
        Stock::create(['category_id' => 2 ,'stock_code_id' => 3, 'serialNumber' => 'Bunsen001', 'stockAvailability'=> true, 'stockQuantity'=> 1, 'stockDescription'=> '', 'price' => '1', 'warrantyStartDate' => '', 'warrantyEndDate' => '']);
        Stock::create(['category_id' => 2 ,'stock_code_id' => 4, 'serialNumber' => 'Bunsen002', 'stockAvailability'=> true, 'stockQuantity'=> 1, 'stockDescription'=> '', 'price' => '1', 'warrantyStartDate' => '', 'warrantyEndDate' => '']);
        

        loanStock::create(['category_id' => 1 ,'stock_code_id' => 1, 'stock_id' => '1', 'user_id'=> '2', '_id'=> '2', 'email'=> 'example@example.com', 'phoneNumber' => '100000000', 'reason' => 'testing', 'supervisorName' => 'Miss Chin', 'estReturnDate' => '2023-07-11 17:52:58.999999', 'termsAndCondition'=> 1]);
        loanStock::create(['category_id' => 1 ,'stock_code_id' => 2, 'stock_id' => '2', 'user_id'=> '2', '_id'=> '2', 'email'=> 'example@example.com', 'phoneNumber' => '100000000', 'reason' => 'testing', 'supervisorName' => 'Miss Chin', 'estReturnDate' => '2023-07-11 17:52:58.999999', 'termsAndCondition'=> 1]);
        loanStock::create(['category_id' => 2 ,'stock_code_id' => 3, 'stock_id' => '3', 'user_id'=> '2', '_id'=> '2', 'email'=> 'example@example.com', 'phoneNumber' => '200000000', 'reason' => 'testing2', 'supervisorName' => 'Miss Chin', 'estReturnDate' => '2023-07-12 17:52:58.999999', 'termsAndCondition'=> 1]);
        
        Approval::create(['loan_stock_id' => 1 ,'status' => 1, 'name'=> 'Moderator', 'position'=> 'dean', 'remark'=> 'testing' ]);
        Approval::create(['loan_stock_id' => 2 ,'status' => 1, 'name'=> 'Moderator', 'position'=> 'dean', 'remark'=> 'testing' ]);
        Approval::create(['loan_stock_id' => 3 ,'status' => 0, 'name'=> 'Moderator', 'position'=> 'dean', 'remark'=> 'testing']);

        returnStock::create(['approval_id' => 1 ,'isSucessful' => 1, ]);
        returnStock::create(['approval_id' => 1 ,'isSucessful' => 0, ]);
       

        //// Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Create the roles
        $role1 = Role::create(['name' => 'SuperAdmin']);
        $role2 = Role::create(['name' => 'Admin']);
        $role3 = Role::create(['name' => 'Default User']);


        //Assign roles to the user
        $user1->assignRole($role1);
        $user2->assignRole($role2);
        $user3->assignRole($role3);


        // create permissions
        Permission::create(['name' => 'View Users']);
        Permission::create(['name' => 'Create Users']);
        Permission::create(['name' => 'Update Users']);
        Permission::create(['name' => 'Delete Users']);

        Permission::create(['name' => 'View Categories']);
        Permission::create(['name' => 'Create Categories']);
        Permission::create(['name' => 'Update Categories']);
        Permission::create(['name' => 'Delete Categories']);

        Permission::create(['name' => 'View Stocks']);
        Permission::create(['name' => 'Create Stocks']);
        Permission::create(['name' => 'Update Stocks']);
        Permission::create(['name' => 'Delete Stocks']);

        Permission::create(['name' => 'View Loan Stocks']);
        Permission::create(['name' => 'Create Loan Stocks']);
        Permission::create(['name' => 'Update Loan Stocks']);
        Permission::create(['name' => 'Delete Loan Stocks']);

        Permission::create(['name' => 'View Return Stocks']);
        Permission::create(['name' => 'Create Return Stocks']);
        Permission::create(['name' => 'Update Return Stocks']);
        Permission::create(['name' => 'Delete Return Stocks']);

        Permission::create(['name' => 'View Loss Stocks']);
        Permission::create(['name' => 'Create Loss Stocks']);
        Permission::create(['name' => 'Update Loss Stocks']);
        Permission::create(['name' => 'Delete Loss Stocks']);

        Permission::create(['name' => 'View Roles']);
        Permission::create(['name' => 'Create Roles']);
        Permission::create(['name' => 'Update Roles']);
        Permission::create(['name' => 'Delete Roles']);

        Permission::create(['name' => 'View Permissions']);
        Permission::create(['name' => 'Create Permissions']);
        Permission::create(['name' => 'Update Permissions']);
        Permission::create(['name' => 'Delete Permissions']);

        Permission::create(['name' => 'View Stock Codes']);
        Permission::create(['name' => 'Create Stock Codes']);
        Permission::create(['name' => 'Update Stock Codes']);
        Permission::create(['name' => 'Delete Stock Codes']);
      

        $role1->givePermissionTo(Permission::all());
        $role2->givePermissionTo(['View Users', 'Create Users','Update Users', 'Delete Users']);
        $role3->givePermissionTo(['']);



    }
}
