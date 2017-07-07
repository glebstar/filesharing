<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->char('public_id', 16)->unique();
            $table->string('name');
            $table->integer('cnt_view')->default(0)->comment('Количество всех скачек');
            $table->integer('cnt_pay_view')->default(0)->comment('Количество оплачиваемых скачек');
            $table->timestamps();
        });

        DB::table('files')->insert([
            'user_id' => 1,
            'public_id' => '595f6d5892601',
            'name' => 'test.txt',
            'cnt_view' => 0,
            'cnt_pay_view' => 0
        ]);

        DB::table('files')->insert([
            'user_id' => 1,
            'public_id' => '595f6dfb4c31c',
            'name' => 'test2.txt',
            'cnt_view' => 0,
            'cnt_pay_view' => 0
        ]);

        DB::table('files')->insert([
            'user_id' => 1,
            'public_id' => '595f6e0e66358',
            'name' => 'test3.txt',
            'cnt_view' => 0,
            'cnt_pay_view' => 0
        ]);

        DB::table('files')->insert([
            'user_id' => 1,
            'public_id' => '595f6e2589af5',
            'name' => 'test4.txt',
            'cnt_view' => 0,
            'cnt_pay_view' => 0
        ]);

        DB::table('files')->insert([
            'user_id' => 1,
            'public_id' => '595f6e415608d',
            'name' => 'test5.txt',
            'cnt_view' => 0,
            'cnt_pay_view' => 0
        ]);

        DB::table('files')->insert([
            'user_id' => 1,
            'public_id' => '595f6e58b46a8',
            'name' => 'test6.txt',
            'cnt_view' => 0,
            'cnt_pay_view' => 0
        ]);

        DB::table('files')->insert([
            'user_id' => 1,
            'public_id' => '595f6e6895ce4',
            'name' => 'test7.txt',
            'cnt_view' => 0,
            'cnt_pay_view' => 0
        ]);

        DB::table('files')->insert([
            'user_id' => 2,
            'public_id' => '595f6e80bb967',
            'name' => 'test8.txt',
            'cnt_view' => 0,
            'cnt_pay_view' => 0
        ]);

        DB::table('files')->insert([
            'user_id' => 2,
            'public_id' => '595f6e9417da1',
            'name' => 'test9.txt',
            'cnt_view' => 0,
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
        Schema::dropIfExists('files');
    }
}
