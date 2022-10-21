<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CpSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
        	[
	            'title' => 'Developer',
	            'code' => 'dev',
	            'rank' => '1',
                'permissions' => json_encode(['access_cp', 'read_roles', 'read_users', 'create_roles']),
	        ],
        	[
	            'title' => 'Administrator',
	            'code' => 'admin',
	            'rank' => '2',
                'permissions' => json_encode(['access_cp', 'read_roles', 'read_dashboard', 'update_roles', 'delete_roles']),
	        ],
        ]);

        DB::table('users')->insert([
        	[
	            'name' => 'John',
	            'email' => 'a@a.a',
	            'password' => '$2y$10$S65MQ9JcHAxla/KX2MoMwumuBlzDPggSe3Es/ccCsg72GNCCkKv2q',
        	],
        	[
	            'name' => 'John2',
	            'email' => 'a2@a.a',
	            'password' => '$2y$10$S65MQ9JcHAxla/KX2MoMwumuBlzDPggSe3Es/ccCsg72GNCCkKv2q',
        	],
        	[
	            'name' => 'John3',
	            'email' => 'a3@a.a',
	            'password' => '$2y$10$S65MQ9JcHAxla/KX2MoMwumuBlzDPggSe3Es/ccCsg72GNCCkKv2q',
        	]
        ]);

        DB::table('role_user')->insert([
            [
                'role_id' => 1,
                'user_id' => 1,
            ],
            [
                'role_id' => 2,
                'user_id' => 1,
            ],
        ]);
    }
}
