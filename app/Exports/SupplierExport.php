<?php

namespace App\Exports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SupplierExport implements FromCollection, WithHeadings
{
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function collection()
    {
        $suppliers = ($q = $this->params['q']) ? Supplier::search($q) : Supplier::query();

        return $suppliers->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'name',
            'company_name',
            'email',
            'phone',
            'address',
            'created_at',
            'updated_at',
        ];
    }
}
