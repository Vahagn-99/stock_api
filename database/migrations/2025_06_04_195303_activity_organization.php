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
        Schema::create('activity_organization', function (Blueprint $table) {
            $table->foreignId('organization_id')
                ->constrained('organizations', 'id')
                ->onDelete("cascade");
            $table->foreignId('activity_id')
                ->constrained('activities', 'id')
                ->onDelete("cascade");
            $table->primary(['organization_id', 'activity_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_organization');
    }
};
