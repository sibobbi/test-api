<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromArray, WithHeadings
{
    public array $orders;
    public function __construct(array $orders)
    {
        $this->orders = $orders;
    }

    /**
    * @return array
     */
    public function array(): array
    {
        return $this->orders;
    }

    public function headings(): array
    {
       return ['Дата','Количество покупок'];
    }
}
