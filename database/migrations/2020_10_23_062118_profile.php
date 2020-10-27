<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Profile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //public function up()
        {
            Schema::create('Profiles', function (Blueprint $table) {
                $table->bigInteger('user_id')->primary();
                $table->string('belong')->default('');
                $table->integer('age')->default(0);
                $table->string('address')->default('');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
