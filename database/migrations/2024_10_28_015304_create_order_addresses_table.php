<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone'); 
            $table->string('province');
            $table->string('district');
            $table->string('ward');
            $table->string('zip');
            $table->string('address_type');
            $table->string('specific_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_addresses');
    }
};
