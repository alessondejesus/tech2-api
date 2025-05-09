<?php

namespace App\Services\ReportServices;

use App\Imports\DGEGReportImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Reports\ImportDGEGReportRequest;

class ImportDGEGReportService
{
    public function handle(ImportDGEGReportRequest $request): void
    {
        $data = $request->validated();
        
        $uploaded = $data['file'];
        
        Excel::import(new DGEGReportImport, $uploaded);
    }
}