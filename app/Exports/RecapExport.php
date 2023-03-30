<?php

namespace App\Exports;

use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Absen;
use App\Models\Recap;
use App\Models\Profile;
use App\Models\MonthlyRecap;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;

class RecapExport implements FromView, WithEvents
{
   use Exportable;

    private $user;
    private $data;
    private $detail;

    public function __construct()
    {
        $export = session()->get('export');

        $this->user = User::where('username', $export )->first();
        $this->data = MonthlyRecap::all();


        foreach ($this->data as $recap) {
            $stmt = Absen::where('name', '=', $this->user->name)->where('date', 'LIKE', '%/'.$recap->num.'/%');
            $recap['hadir'] = $stmt->count();
            
            $recap['absen'] = 0;
            $recap['telat'] = $stmt->where('status', 'telat')->count();
            $recap['jamker'] = 0;
            
            $absen = Absen::where('name', '=', $this->user->name)->where('date', 'LIKE', '%/'.$recap->num.'/%')->get();

            foreach ($absen as $count) {
                if ($count['clock_in'] !== '-' && $count['clock_out'] !== '-') {
                    $rawIn = explode(':', $count['clock_in']);
                    $rawOut = explode(':', $count['clock_out']);
        
                    $recap['jamker'] +=  + intval($rawOut[0]) - intval($rawIn[0]);
                }
            }
        } 

        $this->detail = Profile::find($this->user->profile->id);
        $this->detail->join_at = Carbon::parse($this->detail->join_at)->format('d/m/Y');
    }

    public function view() : View
    {
        return view('pdf-report.recap',[
            'title' => 'Rekap Absen',
            'style' => 'excel',
            'user' => $this->user,
            'detail' => $this->detail,
            'data' => $this->data
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(18);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(5);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(9);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(14);
     
            },
        ];
    }
}
