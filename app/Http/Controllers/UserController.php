<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Profile;
use App\Models\Division;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function members()
    {
        return view('administrator.data-pegawai', [
            "title" => "Data Pegawai",
            "style" => 'members',
            "profile" => Profile::get(),
            "division" => Division::all(),
            "position" => Position::all()
        ]);
    }

    public function show(User $user)
    {
        $detail = Profile::find($user->profile->id);
        $detail->join_at = Carbon::parse($detail->join_at)->format('d/m/Y');

        return view('profile.index', [
            'title' => 'Profile',
            'style' => '',
            'data' => $user,
            'detail' => $detail,
        ]);
    }

    public function store(Request $request)
    {  
        $validated = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|unique:users|email:dns',
            'jabatan' => 'nullable',
            'divisi' => 'nullable'
        ]);

        $raw = explode(' ', $validated['name']);
        $validated['username'] = '';

        foreach ($raw as $row) {
            $validated['username'] .= strtolower($row);
        }
        
        User::create([
            'username' => $validated['username'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['email']),
        ]);

        Profile::create([
            'user_id' => User::where('name', $validated['name'])->first(['id'])->id,
            'position_id' => $validated['jabatan'],
            'division_id' => $validated['divisi'],
            'join_at' => now()
        ]);

        return redirect('/data-pegawai')->with('success', 'Akun pegawai berhasil ditambahkan!');
    }

    public function destroy(Request $request) 
    {
        User::where('id', $request->user_id)->delete();
        Profile::where('id', $request->profile_id)->delete();
        
        return redirect('/data-pegawai')->with('success', 'Akun berhasil dihapuskan!');
    }
}
