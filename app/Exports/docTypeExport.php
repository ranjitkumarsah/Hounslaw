<?php

namespace App\Exports;

use App\Models\DocumentType;
use App\Models\Country;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class docTypeExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = DocumentType::join('countries','countries.code','=','document_types.country_code')->select('countries.name','countries.code','document_types.*')->get();
        return $data;
    }

    public function headings(): array
    {
        // Specify the column names you want in the export
        return [
            'S.No',
            'Country Code',
            'Country',
            'Document Code',
            'Document Name',
            'Width in Pixel',
            'Height in Pixel'
            
        ];
    }

    public function map($data): array
    {
        static $rowNumber = 0;
        $rowNumber++;
        return [
            $rowNumber,
            $data->code,
            $data->name,
            $data->doc_code,
            $data->doc_name,
            $data->width,
            $data->height,
            
        ];
    }

}
