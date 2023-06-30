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
        Schema::create('return_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_stock_id')->constrained()->cascadeOnDelete();
            $table->boolean('isSucessful')->default(false);
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_stocks');
    }
};
