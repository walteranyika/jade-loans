<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCreditsTable extends Migration
{
    public function up()
    {
        Schema::table('credits', function (Blueprint $table) {
            $table->unsignedInteger('client_id');
            $table->foreign('client_id', 'client_fk_1596677')->references('id')->on('clients');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id', 'product_fk_1596678')->references('id')->on('products');
            $table->unsignedInteger('guarantor_id');
            $table->foreign('guarantor_id', 'guarantor_fk_1596680')->references('id')->on('guarantors');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_fk_1596682')->references('id')->on('users');
            $table->unsignedInteger('location_id');
            $table->foreign('location_id', 'location_fk_1596715')->references('id')->on('locations');
        });
    }
}
