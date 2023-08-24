<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meta', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->text('head')->nullable();
            $table->text('body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta');
    }
};
