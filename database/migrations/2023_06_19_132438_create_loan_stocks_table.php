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
        Schema::create('loan_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete(); 
           
            $table->foreignId('stock_code_id')->constrained()->cascadeOnDelete();
            $table->foreignId('stock_id')->constrained()->cascadeOnDelete();
            
            $table->string('name');
            $table->string('_id');
            $table->string('email');
            $table->string('phoneNumber');
            $table->string('reason');
            $table->string('supervisorName');
            $table->date('estReturnDate');
            $table->boolean('termsAndCondition');
           
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_stocks');
    }
};
