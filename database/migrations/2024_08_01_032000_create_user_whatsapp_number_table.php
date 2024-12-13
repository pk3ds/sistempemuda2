<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_whatsapp_number', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('whatsapp_number_id')->constrained('whatsapp_numbers')->onDelete('cascade');
            $table->timestamps();

            // Adding a unique constraint to prevent duplicate relationships
            $table->unique(['user_id', 'whatsapp_number_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_whatsapp_number');
    }
}; 