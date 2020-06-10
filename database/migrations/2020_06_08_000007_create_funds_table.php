<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundsTable extends Migration
{
    public function up()
    {
        Schema::create('funds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('asset_name');
            $table->string('asset_category');
            $table->decimal('amount', 15, 2);
            $table->string('type');
            $table->string('made_by');
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
