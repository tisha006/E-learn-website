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
        Schema::create('reg', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key (bigint)
            $table->string('name'); // VARCHAR equivalent column for name
            $table->string('email')->unique(); // VARCHAR equivalent column for email with unique index
            $table->string('password'); 
            $table->string('status');
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reg');
    }
};
