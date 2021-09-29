<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
              'role_id'   => Role::where('name', 'admin')->first()->id,
              'name'      => config('admin.api.key.name'),
              'email'     => config('admin.api.key.email'),
              'password'  => bcrypt(config('admin.api.key.password')),
            ],
          ];
          \DB::table('users')->insert($data);
    }
}
