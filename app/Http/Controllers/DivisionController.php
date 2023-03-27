<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Division;
use App\Models\Position;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    
    public function index()
    {

        $data = Division::get();
        foreach ($data as $filtered) {
            $filtered['member_sum'] = Profile::where('division_id', $filtered->id)->count();
        }

        return view('administrator.data-sekbid', [
            'title' => 'Data Sekbid',
            'style' => 'members',
            'data' => $data,
            'user' => Profile::all(),
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
        $shortSlug = '';

        foreach ($raw as $row) {
            $slug .= strtolower($row) . '-'; // long slug ex: tata usaha -> tata-usaha (good for url)
            $shortSlug .= strtoupper(substr($row, 0, 1)); // short slug ex: tata usaha -> tu (good for profile)
            $validName .= ucfirst($row) . ' ';
        }

        $lead = Profile::where('id', $request->lead)->get(['user_id']);

        Division::create([
            'name' => substr($validName, 0, -1),
            'lead' => $lead->first()->user_id,
            'slug' => substr($slug, 0, -1),
            // 'slug' => $slug
        ]);

        if ($request->lead != null) {
            $setPosition = 'Pimpinan Sekbid ' . $shortSlug;

            Position::create([
                'name' => $setPosition,
                'slug' => 'lead-' . strtolower($shortSlug),
            ]);

            $getPosition = Position::where('name', $setPosition)->first()->id;
            $getDivid = Division::where('name', substr($validName, 0, -1))->first()->id;


            Profile::where('id', $request->lead)->update(['position_id' => $getPosition, 'division_id' => $getDivid ]);
        }

        return redirect('/data-sekbid')->with('success', 'Seksi bidang berhasil ditambahkan!');

    }

    public function destroy(Request $request)
    {
        $getLead = Division::where('id', $request->div_id)->first()->lead;
        $delPos = Profile::where('id', $getLead)->first()->position_id;

        Position::where('id', $delPos)->delete();
        Division::where('id', $request->div_id)->delete();
        Profile::where('division_id', $request->div_id)->update(['division_id' => null]);
        
        return redirect('/data-sekbid')->with('success', 'Seksi bidang berhasil dihapuskan!');
    }

    public function edit(Request $request)
    {
        

    }

}