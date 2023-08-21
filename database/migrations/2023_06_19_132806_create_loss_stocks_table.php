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
        Schema::create('loss_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('approval_id')->constrained()->cascadeOnDelete();   
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('username')->nullable();      
            $table->string('lostType');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loss_stocks');
    }
};
