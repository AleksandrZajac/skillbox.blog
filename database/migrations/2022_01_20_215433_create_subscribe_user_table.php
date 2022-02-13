<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Role;
use App\Models\Subscribe;

class CreateSubscribeUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribe_user', function (Blueprint $table) {
            $table->BigInteger('subscribe_id');
            $table->BigInteger('user_id');
            $table->timestamps();
        });

        DB::table('subscribe_user')->insert([
            'subscribe_id' => Subscribe::where('name', 'web-socket')->get()->first()->id,
            'user_id' => Role::roleAdmin()->first()->id,
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribe_user');
    }
}
