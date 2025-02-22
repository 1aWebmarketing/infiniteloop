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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->string('type'); // GITHUB, TASKIFY, Whatever
            $table->string('remote_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
