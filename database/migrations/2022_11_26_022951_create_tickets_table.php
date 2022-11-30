<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->string('invoice_number');
            $table->bigInteger('vendor_id');
            $table->string('name');
            $table->string('email');
            $table->string('contact_number');
            $table->text('description')->fullText();
            $table->text('comments')->nullable();
            $table->enum('status', ['pending', 'reviewing', 'closed'])->default('pending');
            $table->timestamps();

            $table->index(['reference_number', 'name']);
        });
        Schema::table('ticket_information', function (Blueprint $table) {
            $table->foreign('ticket_id')->references('id')->on('tickets');
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
};
