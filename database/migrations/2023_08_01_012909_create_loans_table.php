<?php

use App\Models\Category;
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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('user_id');
            $table->string('username');
            $table->string('email');
            $table->string('phoneNumber');
            $table->string('reason');
            $table->string('supervisorName');
            $table->date('startLoanDate');
            $table->date('estReturnDate');
            $table->boolean('termsAndCondition')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }

    
};
