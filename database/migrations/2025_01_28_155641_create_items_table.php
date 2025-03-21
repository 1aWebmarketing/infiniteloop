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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id');
            $table->timestamps();

            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id');

            $table->string('title');
            $table->text('story');
            $table->string('status')->default('CREATED');
            $table->string('priority')->default('LOW');
            $table->string('type')->default('TASK');
            $table->integer('voting')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
