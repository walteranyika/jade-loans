<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('package_name');
            $table->decimal('amount', 15, 2);
            $table->decimal('deposit', 15, 2);
            $table->integer('duration');
            $table->string('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
