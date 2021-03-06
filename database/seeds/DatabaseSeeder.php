<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(DashboardTablesSeeder::class);
        $this->call(AttendeStatusSeeder::class);
        $this->call(DocumentStatusSeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(CallTypeTableSeeder::class);
    }
}
