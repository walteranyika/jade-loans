<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRepaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('repayments', function (Blueprint $table) {
            $table->unsignedInteger('client_id');
            $table->foreign('client_id', 'client_fk_1596690')->references('id')->on('clients');
            $table->unsignedInteger('loan_id');
            $table->foreign('loan_id', 'loan_fk_1596691')->references('id')->on('credits');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_fk_1596694')->references('id')->on('users');
        });
    }
}
