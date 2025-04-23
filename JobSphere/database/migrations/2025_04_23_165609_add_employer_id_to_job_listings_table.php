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
        Schema::table('job_listings', function (Blueprint $table) {
            $table->foreignId('employer_id')->constrained()->onDelete('cascade');
            // This will create a foreign key constraint on the employer_id column
            // that references the id column on the employers table.
            // The onDelete('cascade') method means that if an employer is deleted,
            // all their job listings will also be deleted.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            //
        });
    }
};