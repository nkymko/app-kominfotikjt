<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Absen;
use App\Models\Shift;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Exports\AbsensExport;
use App\Imports\AbsensImport;
use Maatwebsite\Excel\Facades\Excel;

class AbsenController extends Controller
{
    public function history()
    {
        // $filt = Absen::all();
        // foreach ($filt as $data) {
        //     if ($data->clock_in != '-') {
        //         $clock_in = explode(':', $data['clock_in']);
        //         $time_in = ['hour' => intval($clock_in[0]), 'minute' => intval($clock_in[1])];
        //         $data->clock_in = $time_in;
        //     }
            
        //     if ($data->clock_out != '-') {
        //         $clock_out = explode(':', $data['clock_out']);
        //         $time_out = ['hour' => intval($clock_out[0]), 'minute' => intval($clock_out[1])];
        //         $data->clock_out = $time_out;
        //     }
        // }

       return view('administrator.riwayat-absen', [
            'title' => 'Riwayat Absen',
            'style' => 'history',
            'data' => Absen::all(),
       ]);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new AbsensImport,request()->file('file'));
        return back()->with('success', 'Import data berhasil!');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new AbsensExport, 'Absen KominfotikJT.xlsx');
    }

    public function recap()
    {
        $users = Profile::all();
        $hourTotal = 0;
        $minuteTotal = 0;

        foreach ($users as $data) {
            $data['total_hadir'] = Absen::where('name', $data->user->name)->count();
            $data['telat'] = Absen::where('status', 'telat')->count();
            $data['workHour'] = 0;

            $workHour = Absen::where('name', $data->user->name)->get(['clock_in', 'clock_out']);
            foreach ($workHour as $hour) {
                if ($hour['clock_in'] !== '-' && $hour['clock_out'] !== '-') {
                    $rawIn = explode(':', $hour['clock_in']);
                    $rawOut = explode(':', $hour['clock_out']);

                    $hourTotal = $hourTotal + intval($rawOut[0]) - intval($rawIn[0]);
                    $minuteTotal = $minuteTotal + intval($rawOut[1]) + intval($rawIn[1]);
                    $data['workHour'] = $hourTotal;
                }
            }
        }

        $getYear = Absen::latest('created_at')->first();
        $setYear = explode('/', $getYear['date']);
       
        return view('administrator.rekap-absen', [
            'title' => 'Rekap Absen',
            'style' => null,
            'data' => $users,
            'month' => $setYear[2],
        ]);
    }
}
