<?php

use App\Models\MailCategory;
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
        Schema::create('mail_outs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('receiver');
            $table->foreignId('mail_category_id')->constrained()->onDelete('cascade');
            $table->string('file')->nullable();
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
        Schema::dropIfExists('mail_outs');
    }
};
