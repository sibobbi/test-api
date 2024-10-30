<?php

namespace App\Http\Controllers;

use App\Enums\FormatType;
use App\Enums\ReportType;
use App\Http\Requests\ReportRequest;
use App\Service\ReportService;

class ReportController extends Controller
{
    public function getReport(ReportRequest $request, ReportService $service)
    {
        $reportType = ReportType::tryFrom($request->type);

        return $service->getForMonth($reportType);
    }
}
