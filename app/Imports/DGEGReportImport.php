<?php

namespace App\Imports;

use Illuminate\Support\Str;
use App\Models\EnergyReport;
use InvalidArgumentException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class DGEGReportImport implements ToCollection, WithChunkReading, WithHeadingRow
{
    /**
     * @param Collection $chunkedConsumptions
     * @return null
     */
    public function collection(Collection $chunkedConsumptions)
    {
        $data = [];

        $now = Carbon::now()->toDateTimeString();

        foreach ($chunkedConsumptions as $key => $consumption) {
            $this->validateConsumptionFields($consumption->toArray(), $key);

            $data[] = [
                'id' => Str::uuid()->toString(),
                'company_name' => $consumption['empresa'],
                'sector_name' => $consumption['setor'],
                'energy_consumption_mwh' => $consumption['consumo_de_energia_mwh'],
                'co2_emissions_ton' => $consumption['emissoes_de_co2_toneladas'],
                'year' => $consumption['ano'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        EnergyReport::query()
            ->insert($data);
    }

    private function validateConsumptionFields(array $consumption, int $key)
    {
        $lineNumber = $key + 1;

        if (!isset($consumption['empresa'])) {
            throw new InvalidArgumentException("Company name is required on line $lineNumber.");
        }

        if (!isset($consumption['setor'])) {
            throw new InvalidArgumentException("Sector name is required on line $lineNumber.");
        }

        if (!isset($consumption['consumo_de_energia_mwh'])) {
            throw new InvalidArgumentException("Consumo de Energia MWH is required on line $lineNumber.");
        }

        if (!isset($consumption['emissoes_de_co2_toneladas'])) {
            throw new InvalidArgumentException("Emissoes de CO2 Toneladas is required on line $lineNumber.");
        }

        if (!preg_match('/^\d{4}$/', $consumption['ano'])) {
            throw new InvalidArgumentException("Ano is not valid on line $lineNumber.");
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
