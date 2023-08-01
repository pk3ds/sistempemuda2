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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facilitator_id')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('division')->nullable();
            $table->integer('points')->default(0);
            $table->boolean('is_committee')->default(false);
            $table->boolean('is_active')->default(false);
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
