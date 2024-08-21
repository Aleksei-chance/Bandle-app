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
        Schema::create('name_blocks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('block_id')->constrained('blocks');
            $table->foreignId('user_id')->constrained('users');

            $table->integer('size')->default(1);
            $table->string('link')->nullable();
            $table->string('name')->nullable();
            $table->string('article')->nullable();
            $table->string('pronouns')->nullable();

            $table->boolean('publish')->default(true);
            $table->boolean('hidden')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('name_blocks');
    }
};
