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
        return view('home', [
            'title' => 'Home',
            'style' => 'home'
        ]);
    }

    public function admin()
    {
        return view('administrator.dashboard.index', [
            "title" => "Dashboard",
            "style" => "home",
            'sum_pegawai' => Profile::count(),
            'sum_divisi' => Division::count(),
        ]);
    }
}
