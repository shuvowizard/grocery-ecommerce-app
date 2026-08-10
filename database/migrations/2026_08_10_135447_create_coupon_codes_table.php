<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupon_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('discount_type', ['fixed', 'percentage'])->nullable()->default('percentage');
            $table->decimal('discount_value', 10, 2)->nullable()->default(0.00);
            $table->integer('usage_limit')->nullable()->default(0);
            $table->integer('used_count')->nullable()->default(0);
            $table->date('starts_at')->nullable();
            $table->date('expires_at')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=Active, 0=Inactive');                   // 1=Active, 0=Inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon_codes');
    }
};
