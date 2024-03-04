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
        Schema::create('home_budgets', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('category_id');
            $table->integer('price');
            $table->integer('created_at');
            $table->integer('updated_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_budgets');
    }
};