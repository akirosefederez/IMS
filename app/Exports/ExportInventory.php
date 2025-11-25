<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;



class ExportInventory implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'CATEGORY ID',
            'LOCATION',

            'BRAND',
            'MODEL',
            'SKU',
            'PRODUCT CODE',
            'UOM',
            'ITEM DESCRIPTION',
            'QUANTITY',
            'STATUS',
            '',

            'DATE',
        ];
    }


}
