<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\DocumentType;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class updateDocSize implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        
        foreach ($rows as $row) {
            
            if (isset($row['doc_code'])) {
                $docType = DocumentType::where('doc_code', $row['doc_code'])->first();
                
                if ($docType) {
                    $docType->width = $row['width'];
                    $docType->height = $row['height'];
                    $docType->save();
  
                }
            }
        }
    }

}
