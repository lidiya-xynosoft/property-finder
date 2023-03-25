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


        DB::table('purposes')->insert([
            [
                'name'          => 'Rent',
                'slug'          => 'rent',
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'name'          => 'Sale',
                'slug'          => 'sale',
                'created_at'    => date("Y-m-d H:i:s")
            ]
        ]);

        DB::table('types')->insert([
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
                'created_at'    => date("Y-m-d H:i:s"),
                'country_id'    => '1',
                'contact_no' => '0123456789'
            ],
            [
                'role_id'       => 2,
                'name'          => 'Agent',
                'username'      => 'agent',
                'email'         => 'agent@agent.com',
                'image'         => 'default.png',
                'about'         => '',
                'password'      => bcrypt('123456'),
                'created_at'    => date("Y-m-d H:i:s"),
                'country_id'    => '1',
                'contact_no' => '0123456780'
            ],
            [
                'role_id'       => 3,
                'name'          => 'User',
                'username'      => 'user',
                'email'         => 'user@user.com',
                'image'         => 'default.png',
                'about'         => null,
                'password'      => bcrypt('123456'),
                'created_at'    => date("Y-m-d H:i:s"),
                'country_id'    => '1',
                'contact_no' => '0123486789'
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
                'slug'          => 'education',
                'class'         => 'text-info',
                'icon'          => 'fas fa-graduation-cap mr-2',
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'name'          => 'Health & Medical',
                'slug'          => 'health_medical',
                'class'         => 'text-success',
                'icon'          => 'fas fa-user-md mr-2',
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'name'          => 'Transportation',
                'slug'          => 'transportation',
                'class'         => 'text-danger',
                'icon'          => 'fas fa-car mr-2',
                'created_at'    => date("Y-m-d H:i:s")
            ]
        ]);

        DB::table('settings')->insert([
            [
                'name'          => 'Property Finder',
                'email'          => 'support@findhouses.com',
                'phone'         => '456 875 369 208',
                'address'          => '95 South Park Avenue, USA',
                'currency'    => 'INR',
                'footer'    => '2021 © Copyright - All Rights Reserved.',
                'aboutus'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum incidunt architecto soluta laboriosam, perspiciatis, aspernatur officiis esse.',
                'facebook'    => 'www.facebook.com',
                'twitter'    => 'www.facebook.com',
                'linkedin'    => 'www.facebook.com',
            ],
        ]);

        DB::table('payment_types')->insert([
            [
                'name'          => 'Cash',
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'name'          => 'Bank',
                'created_at'    => date("Y-m-d H:i:s")
            ],
        ]);
        DB::table('document_types')->insert([
            [
                'title'          => 'Aadhar',
                'description'          => 'Aadhar',
                'is_active'          => '1',
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'title'          => 'PAN',
                'description'          => 'pan',
                'is_active'          => '1',
                'created_at'    => date("Y-m-d H:i:s")
            ],
        ]);
    }
}