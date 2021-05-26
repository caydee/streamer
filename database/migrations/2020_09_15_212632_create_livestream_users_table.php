<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivestreamUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livestream_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("livestream_id")->index();
            $table->unsignedBigInteger("user_id")->index();
            $table->string("uniqueid");

            $table->boolean("notified")->default(0);
            $table->integer("visits")->default(0);
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livestream_users');
    }
}
