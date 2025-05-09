<?php

namespace App\Services\ReportServices;

use App\Models\EnergyReport;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\ArrayShape;

class CurrentEmissionService
{
    #[ArrayShape(['total_all_time' => Collection::class, 'total_current_year' => Collection::class])]
    public function handle(): array
    {
        $totalAllTime = EnergyReport::query()
            ->selectRaw('
                SUM(energy_consumption_mwh) as total_energy_consumption_mwh,
                SUM(co2_emissions_ton) as total_co2_emissions_ton,
                SUM(energy_consumption_mwh + co2_emissions_ton) as total_consumption')
            ->first();

        $year = now()->year;

        $totalCurrentYear = EnergyReport::query()
            ->where('year', $year)
            ->selectRaw('
               SUM(energy_consumption_mwh) as total_energy_consumption_mwh,
               SUM(co2_emissions_ton) as total_co2_emissions_ton,
                SUM(energy_consumption_mwh + co2_emissions_ton) as total_consumption')
            ->first();
            
        return [
            'total_all_time' => $totalAllTime,
            'total_current_year' => $totalCurrentYear,
        ];
    }
}