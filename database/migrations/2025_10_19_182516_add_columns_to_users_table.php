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
            $table->boolean('marketing_opt_in')->default(false)->after('email_verified_at');
            $table->timestamp('last_active_at')->nullable()->after('marketing_opt_in');
            $table->string('status')->default('active')->after('last_active_at');

            $table->index('marketing_opt_in');
            $table->index('last_active_at');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
