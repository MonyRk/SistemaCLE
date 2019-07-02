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
            $table->string('name');
            $table->string('curp_user',20)->nullable();
            $table->foreign('curp_user')->references('curp')->on('personas')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('email',200);
            $table->string('password');
            $table->unique([DB::raw('email(191)')]);
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
