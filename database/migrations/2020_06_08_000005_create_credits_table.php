<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditsTable extends Migration
{
    public function up()
    {
        Schema::create('credits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->integer('status');
            $table->date('date_issued');
            $table->integer('total_repayment');
            $table->integer('balance');
            $table->string('mpesa_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
