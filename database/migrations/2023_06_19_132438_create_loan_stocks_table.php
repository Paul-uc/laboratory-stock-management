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
            
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            $table->string('userId');

            $table->string('email');
            $table->string('phoneNumber');
            $table->string('reason');
            $table->string('supervisorName');
            $table->date('startLoanDate')->format('d-m-Y');
            $table->date('estReturnDate')->format('d-m-Y');
            $table->boolean('termsAndCondition')->default(false);
           
          
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
