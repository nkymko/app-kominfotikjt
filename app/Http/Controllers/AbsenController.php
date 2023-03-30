<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Absen;
use App\Models\Recap;
use App\Models\Shift;
use App\Models\Profile;
use App\Models\MonthlyRecap;
use Illuminate\Http\Request;
use App\Exports\AbsensExport;
use App\Imports\AbsensImport;
use App\Exports\RecapExport;
use PDF;
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
        $data = MonthlyRecap::all();


        foreach ($data as $recap) {
            $stmt = Absen::where('name', '=', $user->name)->where('date', 'LIKE', '%/'.$recap->num.'/%');
            $recap['hadir'] = $stmt->count();
            
            $recap['absen'] = 0;
            $recap['telat'] = $stmt->where('status', 'telat')->count();
            $recap['jamker'] = 0;
            
            $absen = Absen::where('name', '=', $user->name)->where('date', 'LIKE', '%/'.$recap->num.'/%')->get();

            foreach ($absen as $count) {
                if ($count['clock_in'] !== '-' && $count['clock_out'] !== '-') {
                    $rawIn = explode(':', $count['clock_in']);
                    $rawOut = explode(':', $count['clock_out']);
        
                    $recap['jamker'] +=  + intval($rawOut[0]) - intval($rawIn[0]);
                }
            }
        } 
        
        return view('recap.index', [
            'title' => 'Rekap Absen',
            'style' => '',
            'data' => $data,
            'user' => $user
        ]);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function recapexport(Request $request) 
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function generatePDF(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        $data = MonthlyRecap::all();


        foreach ($data as $recap) {
            $stmt = Absen::where('name', '=', $user->name)->where('date', 'LIKE', '%/'.$recap->num.'/%');
            $recap['hadir'] = $stmt->count();
            
            $recap['absen'] = 0;
            $recap['telat'] = $stmt->where('status', 'telat')->count();
            $recap['jamker'] = 0;
            
            $absen = Absen::where('name', '=', $user->name)->where('date', 'LIKE', '%/'.$recap->num.'/%')->get();

            foreach ($absen as $count) {
                if ($count['clock_in'] !== '-' && $count['clock_out'] !== '-') {
                    $rawIn = explode(':', $count['clock_in']);
                    $rawOut = explode(':', $count['clock_out']);
        
                    $recap['jamker'] +=  + intval($rawOut[0]) - intval($rawIn[0]);
                }
            }
        } 

        $detail = Profile::find($user->profile->id);
        $detail->join_at = Carbon::parse($detail->join_at)->format('d/m/Y');
        
        $pdf = PDF::loadView('pdf-report.recap', [
            'title' => 'Rekap Absen',
            'style' => '',
            'user' => $user,
            'detail' => $detail,
            'data' => $data
        ]);

        return $pdf->download('Rekap Absen.pdf');
    }
}