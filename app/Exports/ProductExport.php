<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection, WithHeadings
{
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function collection()
    {
        $products = ($q = $this->params['q']) ? Product::search($q) : Product::query();

        return $products->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'barcode',
            'name',
            'description',
            'uom_id',
            'price',
            'stock',
            'created_at',
            'updated_at',
        ];
    }
}
