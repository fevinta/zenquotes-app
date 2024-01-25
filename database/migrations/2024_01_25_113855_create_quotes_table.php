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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained();
            $table->text('quote');
            $table->timestamps();

            $table->unique(['author_id', 'quote']);
        });

        Schema::create('quote_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();

            $table->unique(['quote_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
