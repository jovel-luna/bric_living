<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;
use App\Models\Entity;
use App\Models\Property;
use App\Models\Role;
use App\Models\User;
use App\Models\UserAccess;
use App\Models\SystemSetting;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Property::where('location_id', 0)->update(['location_id'=> 8]);
        Role::create([
            'role' => 'Admin'
            ]);

        Role::create([
            'role' => 'Staff'
        ]);

        User::create([
            'role_id' => 1,
            'username' => 'super_sysadmin',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'status' => 1,
            'email' => 'dev2021testmail01@gmail.com',
            'profile_image' => 'storage/profiles/1_super_sysadmin.png',
            'password' => '$2y$10$3pdsbqkKmTyJ0GHwLugM3.Zqcey7EcaLVy2j.AU.DNK6gEVrOrj8G',
        ]);

        UserAccess::create([
            'user_id' => 1,
            'can_import' => 1,
            'lettings_table_edit' => 1,
        ]);

        SystemSetting::create([
            'system_logo' => 'storage/system/system_logo.png',
            'system_name' => 'Property Management Portal',
        ]);

        Location::create([
            'postcode' => 'postcode',
            'city' => 'city',
            'area' => 'area'
        ]);

        Entity::create([
            'company_registration_number' => 123456,
            'entity' => 'Default',
            'registered_address' => 'N/A',
            'entity_date_created' => 'N/A',
            'statement_due_date' => 'N/A',
            'financial_year_start_date' => 'N/A',
            'financial_year_end_date' => 'N/A',
        ]);

    }
}
