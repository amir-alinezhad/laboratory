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
        Schema::create('order_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();

            $table->enum('step_type', ['imaging','molding','test','delivery']);
            $table->enum('performed_by', ['lab','dentist']);
            $table->enum('status', ['pending','done'])->default('pending');

            $table->text('description')->nullable();
            $table->timestamp('step_date')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_steps');
    }
};
