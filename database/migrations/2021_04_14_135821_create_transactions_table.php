<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id')->references('id')->on('films')->onDelete("cascade");
            $table->foreignId('user_id')->references('id')->on('users')->onDelete("cascade");
            $table->integer('qty');
            $table->integer('cost');
            $table->enum('status', ['approve', 'decline'])->default('approve');
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
        Schema::dropIfExists('transactions');
    }
}
