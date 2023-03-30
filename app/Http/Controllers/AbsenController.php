<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Absen;
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

       return view('administrator.presence.history', [
            'title' => 'Riwayat Absen',
            'style' => 'history',
            'data' => Absen::all(),
       ]);
    }

    public function userhistory(User $user)
    {

       return view('administrator.presence.history', [
            'title' => 'Riwayat Absen',
            'style' => 'history',
            'data' => Absen::where('name', $user->name)->get(),
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
        $data = Profile::all();

        foreach ($data as $profile) {
            session()->put($profile->user->name, 'false');
        }

        return view('administrator.presence.recap', [
            'title' => 'Rekap Absen',
            'style' => null,
            'data' => Profile::all(),
        ]);
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

        session()->put('export', $request->username);

        return Excel::download(new RecapExport, 'rekap_' . $request->username . '_' . uniqid() . '.xlsx');
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
            'style' => 'pdf',
            'user' => $user,
            'detail' => $detail,
            'data' => $data
        ])->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('rekap_'. $user->username . '_' . uniqid() .'.pdf');
    }
}