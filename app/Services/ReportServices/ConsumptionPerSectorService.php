<?php

namespace App\Services\ReportServices;

use App\Models\EnergyReport;
use Illuminate\Database\Eloquent\Collection;

class ConsumptionPerSectorService
{
    public function handle(): Collection
    {
        return EnergyReport::query()
            ->selectRaw('sector_name, 
                SUM(energy_consumption_mwh) as total_energy_consumption_mwh, 
                SUM(co2_emissions_ton) as total_co2_emissions_ton, 
                SUM(energy_consumption_mwh + co2_emissions_ton) as total_consumption')
            ->groupBy('sector_name')
            ->orderByDesc('total_consumption')
            ->limit(10)
            ->get();
    }
}