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
        Schema::create('procurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->string('amount');            
            $table->string('price');
            $table->string('total_price');            
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected','completed'])->default('pending');            
            $table->text('reason')->nullable();
            $table->string('receipt')->nullable();
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
        Schema::dropIfExists('procurements');
    }
};
