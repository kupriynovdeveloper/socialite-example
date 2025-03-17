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
        Schema::create('db_listen_logs', function (Blueprint $table) {
            $table->id();
            $table->string('user')->nullable();
            $table->string('count_requests')->nullable();
            $table->text('sql')->nullable();
            $table->string('status')->nullable();
            $table->string('time')->nullable();
            $table->text('message')->nullable();
            $table->string('route')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('db_listen_logs');
    }
};
