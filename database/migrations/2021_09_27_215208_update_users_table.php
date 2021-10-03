<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Role;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->default(Role::roleUser()->first()->id);

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        $data = [
            [
              'role_id'   => Role::roleAdmin()->first()->id,
              'name'      => config('admin.api.key.name'),
              'email'     => config('admin.api.key.email'),
              'password'  => bcrypt(config('admin.api.key.password')),
            ],
        ];

        \DB::table('users')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
