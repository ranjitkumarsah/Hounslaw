<?php

namespace App\Exports;

use App\Models\DocumentType;
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
        return DocumentType::all();
    }

    public function headings(): array
    {
        // Specify the column names you want in the export
        return [
            'id',
            'doc_name',
            'doc_code',
            'width',
            'height'
            
        ];
    }

    public function map($documentType): array
    {
       
        return [
            $documentType->id,
            $documentType->doc_name,
            $documentType->doc_code,
            $documentType->width,
            $documentType->height,
            
        ];
    }

}
