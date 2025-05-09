<?php

namespace App\Services\ReportServices;

use App\Models\EnergyReport;
use Illuminate\Database\Eloquent\Collection;

class ConsumptionPerYearService
{
    public function handle(): Collection
    {
        return EnergyReport::query()
            ->selectRaw('year, 
                SUM(energy_consumption_mwh) as total_energy_consumption_mwh, 
                SUM(co2_emissions_ton) as total_co2_emissions_ton')
            ->groupBy('year')
            ->orderBy('year')
            ->get();
    }
}