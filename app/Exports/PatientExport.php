<?php

namespace App\Exports;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PatientExport implements FromCollection, withHeadings
{
    use Exportable;

    public function collection()
    {
        return Patient::select('name','blood_pressure')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
       return ['Name','Blood Pressure'];
    }
}
