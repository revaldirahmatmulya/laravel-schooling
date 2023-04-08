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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('code', 255);
            $table->string('title', 255);
            $table->string('location', 255);
            $table->integer('stock');
            $table->foreignId('author_id')->nullable()->constrained('authors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('book_categories')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('books');
    }
};
