<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;

class DivisionController extends Controller
{
    
    public function index()
    {
        return view('administrator.data-sekbid', [
            "title" => "Data Sekbid",
            "style" => "",
            "data" => Division::all()
        ]);
    }

    public function store(Request $request)
    {   
        $validated = $request->validate([
            'name' => 'required|min:3|max:50',
            'lead' => 'required|numeric|max:24',
        ]);

        Division::create($validated);

        return redirect('/shift')->with('success', 'Shift Kerja berhasil ditambahkan!');
    }

}