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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('employer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('job_categories')->onDelete('cascade');
            $table->decimal('budget_min', 10, 2)->nullable();
            $table->decimal('budget_max', 10, 2)->nullable();
            $table->enum('budget_type', ['fixed', 'hourly', 'negotiable'])->default('negotiable');
            $table->string('location');
            $table->enum('job_type', ['full_time', 'part_time', 'freelance', 'contract']);
            $table->enum('status', ['draft', 'pending', 'approved', 'active', 'completed', 'cancelled'])->default('pending');
            $table->date('deadline')->nullable();
            $table->json('requirements')->nullable();
            $table->json('skills_required')->nullable();
            $table->integer('applications_count')->default(0);
            $table->boolean('is_urgent')->default(false);
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
