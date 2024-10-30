<?php

namespace App\Service;

use App\Enums\ReportType;
use App\Exports\OrdersExport;
use App\Models\Order;
use Carbon\Carbon;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class ReportService
{
    public function getForMonth(ReportType $reportType)
    {
        $orders = Order::query()->whereMonth('created_at', Carbon::now()->month)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $this->validate($orders);

        $reports = [];

        foreach ($orders as $data) {
            $reports[] = [
                'date' => $data->date,
                'count' => $data->count,
            ];
        }

        return match ($reportType) {
            ReportType::JSON => response()->json($reports),
            ReportType::CSV => Excel::download(new OrdersExport($reports), 'orders.csv'),
        };
    }


    private function validate($orders): void
    {
        if (!$orders->isNotEmpty()) {
            throw new Exception('Список заказов пуст');
        }
    }
}
