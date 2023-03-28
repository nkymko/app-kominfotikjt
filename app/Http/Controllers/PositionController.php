<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $data = Position::all();
        foreach ($data as $filtered) {
            $filtered['member_sum'] = Profile::where('position_id', $filtered->id)->count();
        }

        return view('administrator.data-jabatan', [
            'title' => 'Data Jabatan',
            'style' => '',
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {   
        $validated = $request->validate([
            'name' => 'required|min:3|max:50',
        ]);

        $raw = explode(' ', $validated['name']);

        // construct
        $validName = '';
        $slug = '';

        foreach ($raw as $row) {
            $slug .= strtolower($row) . '-'; // long slug ex: tata usaha -> tata-usaha (good for url)
            $validName .= ucfirst($row) . ' ';
        }

        Position::create([
            'name' => substr($validName, 0, -1),
            'slug' => substr($slug, 0, -1),
        ]);

        return redirect('/data-jabatan')->with('success', 'Jabatan baru berhasil ditambahkan!');

    }

    public function destroy(Request $request)
    {
        Position::where('id', $request->pos_id)->delete();
        Profile::where('position_id', $request->pos_id)->update(['position_id' => null]);
        
        return redirect('/data-jabatan')->with('success', 'Seksi bidang berhasil dihapuskan!');
    }
}
