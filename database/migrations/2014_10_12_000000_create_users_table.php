<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login', 64)->unique();
            $table->string('password');
            $table->integer('cnt_pay_view')->default(0)->comment('Суммарное число оплачиваемых скачек');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'login' => 'test',
            'password' => bcrypt('123456'),
            'cnt_pay_view' => 0
        ]);

        DB::table('users')->insert([
            'login' => 'test2',
            'password' => bcrypt('123456'),
            'cnt_pay_view' => 0
        ]);
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
