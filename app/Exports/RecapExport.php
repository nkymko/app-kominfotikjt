<?php

namespace App\Exports;

use App\Models\Recap;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RecapExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Recap::select('month', 'presence', 'absence', 'late', 'workHour');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Bulan", "Total Hadir", "Sakit/Izin", "Keterlambatan", "Jam Kerja"];
    }
}
