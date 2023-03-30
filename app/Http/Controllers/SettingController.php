<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('administrator.settings.index', [
            'title' => 'Settings',
            'style' => 'settings',
            // 'data' => Shift::all(),
        ]);
    }

    public function store(Request $request)
    {   
        $validated = $request->validate([
            'name' => 'required|min:3|max:50',
            'hour_in' => 'required|numeric|max:24',
            'minute_in' => 'required|numeric|max:60',
            'hour_out' => 'required|numeric|max:24',
            'minute_out' => 'required|numeric|max:60',
        ]);

        Shift::create($validated);

        return redirect('/shift')->with('success', 'Shift Kerja berhasil ditambahkan!');
    }
}
