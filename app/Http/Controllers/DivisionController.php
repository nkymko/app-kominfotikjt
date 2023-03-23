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
        ]);

        $raw = explode(' ', $validated['name']);
        $validName = '';
        $slug = '';

        foreach ($raw as $row) {
            $slug .= strtolower($row) . '-';

            $validName .= ucfirst($row) . ' ';
        }

        Division::create([
            'name' => substr($validName, 0, -1),
            'user_id' => $request['lead'],
            'slug' => substr($slug, 0, -1),
        ]);

        return redirect('/data-sekbid')->with('success', 'Seksi bidang berhasil ditambahkan!');

    }

    public function destroy(Request $request)
    {
        Division::where('id', $request->div_id)->delete();
        
        return redirect('/data-sekbid')->with('success', 'Seksi bidang berhasil dihapuskan!');
    }

}