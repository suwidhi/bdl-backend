<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
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
        $genVIN = function($num){
            return strtoupper(substr(md5($num), -10));
        };
        // pertama user type dulu
        DB::table('user_types')->insert([
            'name' => 'automobile'
        ]);
        DB::table('user_types')->insert([
            'name' => 'dealer'
        ]);
        DB::table('user_types')->insert([
            'name' => 'supplier'
        ]);
        DB::table('user_types')->insert([
            'name' => 'manufacturer'
        ]);
        DB::table('user_types')->insert([
            'name' => 'user'
        ]);

        // tambahkan user baru untuk root user
        DB::table('users')->insert([
            'name' => 'Automobile',
            'email' => 'automobile@navi.com',
            'type' => 1,
            'password' => '$2y$10$pm07c0jJ1JpAPCFldzW0Cu2F0t0G3BLs4nCAmVUdR5A7J5is/zDPu', // navi
        ]);

        // user dealer baru
        DB::table('users')->insert([
            'name' => 'Dealer1',
            'email' => 'dealer1@navi.com',
            'type' => 2,
            'password' => '$2y$10$pm07c0jJ1JpAPCFldzW0Cu2F0t0G3BLs4nCAmVUdR5A7J5is/zDPu', // navi
        ]);

        DB::table('dealers')->insert([
            'account' => 2,
            'name' => 'Dealer1',
            'motto' => '',
            'description' => ''
        ]);

        DB::table('users')->insert([
            'name' => 'Dealer2',
            'email' => 'dealer2@navi.com',
            'type' => 2,
            'password' => '$2y$10$pm07c0jJ1JpAPCFldzW0Cu2F0t0G3BLs4nCAmVUdR5A7J5is/zDPu', // navi
        ]);

        DB::table('dealers')->insert([
            'account' => 3,
            'name' => 'Dealer2',
            'motto' => '',
            'description' => ''
        ]);

        // data employee type
        DB::table('employee_types')->insert([
            'name' => 'Admin',
        ]);

        // data employee
        DB::table('employees')->insert([
            'type' => 1,
            'dealer' => 1,
            'name' => 'Ivan',
            'email' => 'ivan@navi.com',
            'phone' => '0812345678',
            'working_date' => '2020-10-10',
            'address' => 'Jimbaran'
        ]);

        // transaction status untuk dealer ke automobile
        DB::table('transaction_statuses')->insert([
            'name' => 'Requested'
        ]);

        DB::table('transaction_statuses')->insert([
            'name' => 'Accepted'
        ]);

        # transaction type
        DB::table('transaction_types')->insert([
            'name' => 'Purchase'
        ]);

        DB::table('transaction_types')->insert([
            'name' => 'Sell'
        ]);

        # add brand
        DB::table('brands')->insert([
            'name' => 'Nissan'
        ]);
        DB::table('brands')->insert([
            'name' => 'Toyota'
        ]);

        # add car type
        DB::table('car_types')->insert([
            'name' => 'Convertible'
        ]);

        # add car model
        DB::table('car_models')->insert([
            'name' => 'Model A',
            'description' => '-'
        ]);
        DB::table('car_models')->insert([
            'name' => 'Model B',
            'description' => '-'
        ]);

        # add car options
        DB::table('car_options')->insert([
            'engine' => 'V8',
            'color' => 'Red',
            'transmission' => 'Manual',
        ]);

        # generate make 3 customer
        DB::table('users')->insert([
            'name' => 'User A',
            'email' => 'usera@navi.com',
            'type' => 3, 
            'password' => '$2y$10$pm07c0jJ1JpAPCFldzW0Cu2F0t0G3BLs4nCAmVUdR5A7J5is/zDPu', // navi
        ]);

        DB::table('customers')->insert([
            'name' => 'User A',
            'account' => 4
        ]);

        DB::table('users')->insert([
            'name' => 'User B',
            'email' => 'userb@navi.com',
            'type' => 3, 
            'password' => '$2y$10$pm07c0jJ1JpAPCFldzW0Cu2F0t0G3BLs4nCAmVUdR5A7J5is/zDPu', // navi
        ]);

        DB::table('customers')->insert([
            'name' => 'User B',
            'account' => 5
        ]);

        DB::table('users')->insert([
            'name' => 'User C',
            'email' => 'userc@navi.com',
            'type' => 3, 
            'password' => '$2y$10$pm07c0jJ1JpAPCFldzW0Cu2F0t0G3BLs4nCAmVUdR5A7J5is/zDPu', // navi
        ]);
        DB::table('customers')->insert([
            'name' => 'User C',
            'account' => 6
        ]);


    }
}
