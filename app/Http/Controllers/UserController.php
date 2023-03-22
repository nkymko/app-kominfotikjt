<?php

namespace App\Http\Controllers;

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
        return view('administrator.data-karyawan', [
            "title" => "Data Karyawan",
            "style" => '',
            "profile" => Profile::get(),
            "division" => Division::all(),
            "position" => Position::all()
        ]);
    }

    public function store(Request $request)
    {  
        $validated = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|unique:users|email:dns',
            'alamat' => 'max:70',
            'phone-num' => 'numeric|nullable',
            'jabatan' => 'required',
            'divisi' => 'required'
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['email']),
        ]);

        Profile::create([
            'user_id' => User::where('name', $validated['name'])->first(['id'])->id,
            'position_id' => $validated['jabatan'],
            'division_id' => $validated['divisi'],
            'address' => $validated['alamat'],
            'phone' => $validated['phone-num'],
            'join_at' => now()
        ]);

        return redirect('/data-karyawan')->with('success', 'Karyawan berhasil ditambahkan!');
    }

    public function destroy(Request $request) 
    {
        User::where('id', $request->user_id)->delete();
        Profile::where('id', $request->profile_id)->delete();
        
        return redirect('/data-karyawan')->with('success', 'Akun berhasil dihapuskan!');
    }
}
