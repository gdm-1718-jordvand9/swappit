<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('sold');
            $table->boolean('published')->default(0);
            $table->decimal('price');
            $table->date('start_date');
            $table->date('end_date');
            $table->dateTime('bump_date');
            $table->longText('code');
            $table->unsignedInteger('user_id')->nullable();
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('ticket_type_id');
            $table->foreign('ticket_type_id')->references('id')->on('ticket_types')->onDelete('cascade');
            $table->unsignedInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
