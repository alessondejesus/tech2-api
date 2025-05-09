<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\ImportDGEGReportRequest;
use App\Services\ReportServices\ImportDGEGReportService;

class ImportDGEGReportController extends Controller
{
    public function __construct(private readonly ImportDGEGReportService $service)
    {
    }
    
    public function __invoke(ImportDGEGReportRequest $request)
    {
        $this->service->handle($request);
    }
}
