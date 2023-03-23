<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Division;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $divisi = Division::get(['id', 'name']);
        $data = array();

        foreach ($divisi as $key) {
            $data[$key->name] = Profile::where('division_id', $key->id)->count();
        }

        return view('home', [
            "title" => "Dashboard",
            "style" => "home",
            'sum_pegawai' => Profile::count(),
            'pegawai_div' => $data,
            'divisi' => Division::get(['name']),
            'sum_divisi' => Division::count(),
        ]);
    }
}
