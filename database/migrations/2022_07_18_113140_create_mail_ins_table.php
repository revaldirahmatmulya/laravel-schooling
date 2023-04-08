<?php

use App\Models\Disposition;
use App\Models\MailCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_ins', function (Blueprint $table) {
            $table->id();
            $table->string('sender');
            $table->string('title');
            $table->foreignId('mail_category_id')->constrained()->onDelete('cascade');
            $table->boolean('is_disposed')->default(false);
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
        Schema::dropIfExists('mail_ins');
    }
};
