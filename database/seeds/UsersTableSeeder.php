<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
           'name'=>'manager',
            'phone'=>'+7 (707) 294-0015',
            'token'=>md5(str_random(10)),
            'password'=>bcrypt('admin123456'),
            'date_last_login'=>date("Y-m-d H:i:s"),
            'role_id'=>'1',
        ]);

        DB::table('users')->insert([
           'name'=>'programmer',
            'phone'=>'+7 (707) 294-0016',
            'token'=>md5(str_random(10)),
            'password'=>bcrypt('admin123456'),
            'date_last_login'=>date("Y-m-d H:i:s"),
            'role_id'=>'2',
        ]);


    }
}
