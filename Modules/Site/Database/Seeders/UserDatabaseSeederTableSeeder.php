<?php

namespace Modules\Site\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserDatabaseSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Taha-Zare',
            'first_name' => 'Taha',
            'last_name' => 'Zare',
            'status' => 1,
            'user_type' => 1,
            'email' => 'tahaazre@gmail.com',
            'mobile' => '9333134032',
            'password'=>'123',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
