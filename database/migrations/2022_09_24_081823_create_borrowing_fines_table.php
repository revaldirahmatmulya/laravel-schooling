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
        Schema::create('borrowing_fines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rental_id')->nullable()->constrained('rentals')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('fine');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('borrowing_fines');
    }
};
