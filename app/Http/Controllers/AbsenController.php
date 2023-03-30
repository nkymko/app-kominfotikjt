<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Absen;
use App\Models\Recap;
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
            'style' => null,
            'data' => Profile::all(),
        ]);
    }

    public function refresh(Request $request)
    {
        $user = User::find($request->user_id);
        $absen = Absen::where('name', $user->name)->get();
        $request['presence'] = $absen->count();
        $request['late'] = Absen::where([
            'name' => $user->name,
            'status' => 'telat'
        ])->count();
        $request['workHour'] = 0;
        $request['absence'] = 0;

        foreach ($absen as $count) {
            if ($count['clock_in'] !== '-' && $count['clock_out'] !== '-') {
                $rawIn = explode(':', $count['clock_in']);
                $rawOut = explode(':', $count['clock_out']);
    
                $request['workHour'] +=  + intval($rawOut[0]) - intval($rawIn[0]);
            }
        }

        $getYear = Absen::where('name', $user->name)->latest('created_at')->first();
        $setYear = explode('/', $getYear['date']);
        $request['year'] = $setYear[2];
        Recap::create([
            'user_id' => $request->user_id,
            'year' => $request->year,
            'workHour' => $request->workHour,
            'presence' => $request->presence,
            'absence' => $request->absence,
            'late' => $request->late
        ]);

        return redirect('/rekap-absen')->with('success', 'Data berhasil dipulihkan!');
    }

    public function show(User $user)
    {
        return view('recap.index', [
            'title' => 'Rekap Absen',
            'style' => '',
            'data' => Recap::where('user_id', $user->id)->first(),
        ]);
    }
}
