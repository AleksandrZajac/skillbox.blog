<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
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
              'name' => config('admin.api.key.name'),
            ],
            [
              'name' => 'user',
            ],
          ];

          \DB::table('roles')->insert($data);
    }
}
