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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'worker', 'employer'])->default('worker');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->default('Bogor');
            $table->string('district')->nullable();
            $table->string('subdistrict')->nullable();
            $table->text('bio')->nullable();
            $table->json('skills')->nullable();
            $table->string('profile_photo')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamp('verified_at')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role', 'phone', 'address', 'city', 'district', 'subdistrict',
                'bio', 'skills', 'profile_photo', 'is_verified', 'is_active',
                'verified_at', 'rating', 'total_reviews'
            ]);
        });
    }
};
