<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Absen;
use App\Models\Shift;
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
        return view('administrator.rekap-absen', [
            'title' => 'Rekap Absen',
            'style' => null
        ]);
    }
}
