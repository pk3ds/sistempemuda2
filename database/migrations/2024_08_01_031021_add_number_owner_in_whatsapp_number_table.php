<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('whatsapp_numbers', function (Blueprint $table) {
      $table->string('address')->nullable();
      $table
        ->foreignId('user_id')
        ->nullable()
        ->constrained();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('whatsapp_number', function (Blueprint $table) {
      $table->dropConstrainedForeignId('user_id');
      $table->dropColumn('address');
    });
  }
};
