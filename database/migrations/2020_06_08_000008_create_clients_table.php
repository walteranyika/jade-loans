<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('id_number');
            $table->string('kra_pin')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('email_address')->nullable();
            $table->string('occupation')->nullable();
            $table->string('application');
            $table->string('added_by');
            $table->string('phone_number');
            $table->string('gender');
            $table->string('zone')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
