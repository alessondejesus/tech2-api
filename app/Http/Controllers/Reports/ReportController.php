<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Services\ReportServices\ConsumptionPerCompanyService;
use App\Services\ReportServices\ConsumptionPerSectorService;
use App\Services\ReportServices\ConsumptionPerYearService;
use App\Services\ReportServices\CurrentEmissionService;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\ArrayShape;

class ReportController extends Controller
{
    public function __construct(
        private readonly ConsumptionPerYearService    $consumptionByYearService,
        private readonly ConsumptionPerSectorService  $consumptionBySectorService,
        private readonly ConsumptionPerCompanyService $consumptionByCompanyService,
        private readonly CurrentEmissionService       $currentEmissionService,
    )
    {
    }

    public function consumptionPerYear(): Collection
    {
        return $this->consumptionByYearService->handle();
    }

    public function consumptionPerSector(): Collection
    {
        return $this->consumptionBySectorService->handle();
    }

    public function consumptionPerCompany(): Collection
    {
        return $this->consumptionByCompanyService->handle();
    }

    #[ArrayShape(['total_all_time' => Collection::class, 'total_current_year' => Collection::class])]
    public function currentEmission(): array
    {
        return $this->currentEmissionService->handle();
    }
}
