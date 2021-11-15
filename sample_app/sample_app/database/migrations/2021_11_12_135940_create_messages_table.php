<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id'); //主キーかつオートインクリメントを有するカラム名id
            $table->string('name', 20); //文字列で20文字制限のカラム名name
            $table->string('body', 100); //文字列で100文字制限のカラム名body
            $table->timestamps(); //created_at（作成日時）とupdated_at（更新日時）というカラムを持つ
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
