<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuarantorsTable extends Migration
{
    public function up()
    {
        Schema::create('guarantors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('idd_number');
            $table->string('id_back');
            $table->string('added_by')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
