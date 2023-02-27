<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);


        DB::table('types')->insert([
            [
                'name'          => 'Rent',
                'slug'          => 'rent',
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'name'          => 'Sale',
                'slug'          => 'sale',
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'name'          => 'Commercial',
                'slug'          => 'commercial',
                'created_at'    => date("Y-m-d H:i:s")
            ]
        ]);

        DB::table('purposes')->insert([
            [
                'name'          => 'House',
                'slug'          => 'house',
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'name'          => 'Apartment',
                'slug'          => 'apartment',
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'name'          => 'Villa',
                'slug'          => 'villa',
                'created_at'    => date("Y-m-d H:i:s")
            ]
        ]);
        DB::table('countries')->insert([
            [
                'name'          => 'India',
                'code'          => 'IN',
                'phone'          => '91',
                'timezone'          => 'UTC +3',
                'currency'          => 'in',
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'name'          => 'Dubai',
                'code'          => 'DXB',
                'phone'          => '974',
                'timezone'          => 'UTC +3',
                'currency'          => 'DHR',
                'created_at'    => date("Y-m-d H:i:s")
            ],
        ]);
        DB::table('users')->insert([
            [
                'role_id'       => 1,
                'name'          => 'Admin',
                'username'      => 'admin',
                'email'         => 'admin@admin.com',
                'image'         => 'default.png',
                'about'         => 'Bio of admin',
                'password'      => bcrypt('123456'),
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'role_id'       => 2,
                'name'          => 'Agent',
                'username'      => 'agent',
                'email'         => 'agent@agent.com',
                'image'         => 'default.png',
                'about'         => '',
                'password'      => bcrypt('123456'),
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'role_id'       => 3,
                'name'          => 'User',
                'username'      => 'user',
                'email'         => 'user@user.com',
                'image'         => 'default.png',
                'about'         => null,
                'password'      => bcrypt('123456'),
                'created_at'    => date("Y-m-d H:i:s")
            ],
        ]);


        DB::table('roles')->insert([
            [
                'name'          => 'Admin',
                'slug'          => 'admin',
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'name'          => 'Agent',
                'slug'          => 'agent',
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'name'          => 'User',
                'slug'          => 'user',
                'created_at'    => date("Y-m-d H:i:s")
            ]
        ]);

        DB::table('nearby_categories')->insert([
            [
                'name'          => 'Education',
                'class'         => 'text-info',
                'icon'          => 'fas fa-graduation-cap mr-2',
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'name'          => 'Health & Medical',
                'class'         => 'text-success',
                'icon'          => 'fas fa-user-md mr-2',
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'name'          => 'Transportation',
                'class'         => 'text-danger',
                'icon'          => 'fas fa-car mr-2',
                'created_at'    => date("Y-m-d H:i:s")
            ]
        ]);
    }
}