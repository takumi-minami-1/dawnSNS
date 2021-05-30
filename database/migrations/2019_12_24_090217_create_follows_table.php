<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // 3.3 サイドバー/フォロー,フォロワー数の表示
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->integer('follow');->unsigned();
            $table->integer('follower');->unsigned();
            $table->timestamp('created_at')->useCurrent();

            $table->index('follow');
            $table->index('follower');

            $table->unique(['follow', 'follower']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
