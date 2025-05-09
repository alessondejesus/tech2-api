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
        Schema::create('energy_reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->year('year');
            $table->string('company_name');
            $table->foreignUuid('sector_name');
            $table->decimal('energy_consumption_mwh', 10);
            $table->decimal('co2_emissions_ton', 10);
            
            $table->index(['year', 'company_name', 'sector_name'], 'idx_year_company_sector');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('energy_reports');
    }
};
