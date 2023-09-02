<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminHashPassword = config('seeder.admin_hash_password');

        if (blank($superAdminHashPassword)) {
            $this->command->getOutput()->error('SUPER_ADMIN_PASSWORD_HASH not defined in .env file.');
            exit();
        }
        //
        $user1 = User::factory()->create([
            'name' => 'SuperAdmin',
            'username' => '21SMR03020',
            'email' => 'superadmin@admin.com',
            'password' => $superAdminHashPassword,
        ]);
        unset($superAdminHashPassword);

        $user2 = User::factory()->create([
            'name' => 'Admin',
            'username' => '21AMR03020',
            'email' => 'admin@admin.com',
        ]);

        $user3 = User::factory()->create([
            'name' => 'Default User',
            'username' => '21DMR03020',
            'email' => 'default@example.com',
        ]);

     

        //// Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Create the roles
        // $role1 = Role::create(['name' => 'SuperAdmin']);
        // $role2 = Role::create(['name' => 'Admin']);
        // $role3 = Role::create(['name' => 'Default User']);


        // //Assign roles to the user
        // $user1->assignRole($role1);
        // $user2->assignRole($role2);
        // $user3->assignRole($role3);

        // User::factory()->createOne([
        //     'name' => 'Demo',
        //     'username' => '21DEMO03020',
        //     'email' => self::demoEmail(),
        //     'password' => self::demoPassword(),
        // ])
        // ->assignRole($role3);

        // // create permissions
        // Permission::create(['name' => 'View Users']);
        // Permission::create(['name' => 'Create Users']);
        // Permission::create(['name' => 'Update Users']);
        // Permission::create(['name' => 'Delete Users']);

        // Permission::create(['name' => 'View Categories']);
        // Permission::create(['name' => 'Create Categories']);
        // Permission::create(['name' => 'Update Categories']);
        // Permission::create(['name' => 'Delete Categories']);

        // Permission::create(['name' => 'View Stocks']);
        // Permission::create(['name' => 'Create Stocks']);
        // Permission::create(['name' => 'Update Stocks']);
        // Permission::create(['name' => 'Delete Stocks']);

        // Permission::create(['name' => 'View Loan Stocks']);
        // Permission::create(['name' => 'Create Loan Stocks']);
        // Permission::create(['name' => 'Update Loan Stocks']);
        // Permission::create(['name' => 'Delete Loan Stocks']);

        // Permission::create(['name' => 'View Return Stocks']);
        // Permission::create(['name' => 'Create Return Stocks']);
        // Permission::create(['name' => 'Update Return Stocks']);
        // Permission::create(['name' => 'Delete Return Stocks']);

        // Permission::create(['name' => 'View Loss Stocks']);
        // Permission::create(['name' => 'Create Loss Stocks']);
        // Permission::create(['name' => 'Update Loss Stocks']);
        // Permission::create(['name' => 'Delete Loss Stocks']);

        // Permission::create(['name' => 'View Roles']);
        // Permission::create(['name' => 'Create Roles']);
        // Permission::create(['name' => 'Update Roles']);
        // Permission::create(['name' => 'Delete Roles']);

        // Permission::create(['name' => 'View Permissions']);
        // Permission::create(['name' => 'Create Permissions']);
        // Permission::create(['name' => 'Update Permissions']);
        // Permission::create(['name' => 'Delete Permissions']);

        // Permission::create(['name' => 'View Stock Codes']);
        // Permission::create(['name' => 'Create Stock Codes']);
        // Permission::create(['name' => 'Update Stock Codes']);
        // Permission::create(['name' => 'Delete Stock Codes']);

        // Permission::create(['name' => 'View Approval']);
        // Permission::create(['name' => 'Create Approval']);
        // Permission::create(['name' => 'Update Approval']);
        // Permission::create(['name' => 'Delete Approval']);


        // $role1->givePermissionTo(Permission::all());
        // $role2->givePermissionTo(['View Users', 'Create Users', 'Update Users', 'Delete Users']);
        // $role3->givePermissionTo(['']);
    }

    public static function demoEmail(): string
    {
        return 'demo@ecommerce.com';
    }

    public static function demoPassword(): string
    {
        return app()->isLocal() ? 'secret' : 'K5D@P^y#Z9v778v7DX9u3#T@mNfVmS';
    }
}
