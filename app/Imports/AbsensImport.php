<?php

namespace App\Imports;

use App\Models\Absen;
use App\Models\Shift;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AbsensImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $status = "-";

        $shift = Shift::first();
 
        if ($row['clock_in'] != null) {
            $clock_in = explode(':', $row['clock_in']);
            $time_in = ['hour' => intval($clock_in[0]), 'minute' => intval($clock_in[1])];
            // $row['clock_in'] = $time_in;
            if ($time_in['hour'] < $shift->hour_in) {
                $status = "On Time";
            } elseif ($time_in['hour'] === $shift->hour_in) {
                if ($time_in['minute'] <= $shift->minute_in ) {
                    $status = "On Time";
                }
                else {
                    $status = "Telat";
                }
            }
        } else {
            $row['clock_in'] = "-";
        }
        
        if ($row['clock_out'] != null) {
            $clock_out = explode(':', $row['clock_out']);
            $time_out = ['hour' => intval($clock_out[0]), 'minute' => intval($clock_out[1])];
            // $row['clock_out'] = $time_out;
        } else {
            $row['clock_out'] = "-";
        }

        return new Absen([
            'uuid'     => $row['ac_no'],
            'name'    => $row['name'],
            'date' => $row['date'],
            'clock_in' => $row['clock_in'],
            'clock_out' => $row['clock_out'],
            'status' => $status,
        ]);
    }
}
