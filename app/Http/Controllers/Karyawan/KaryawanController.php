<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:karyawan');
    }

    public function index()
    {
        $karyawan = Karyawan::with(['user.role'])
                ->where('user_id', Auth::id())
                ->first();

        if (!$karyawan) {
            return redirect()->route('karyawan.create')->with('error', 'Silakan lengkapi data karyawan Anda terlebih dahulu.');
        }

        return view('karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        if (Karyawan::where('user_id', $userId)->exists()) {
            return redirect()->route('karyawan.index')->with('error', 'Data karyawan sudah ada.');
        }

        $validated = $request->validate([
            'nip' => 'required|string|unique:karyawans,nip',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'departemen' => 'required|string|max:255',
            'detail_jabatan' => 'required|string|max:255',
            'edukasi' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'no_telepon' => 'required|string|max:20',
        ]);

        $validated['user_id'] = $userId;
        $validated['status'] = 'Aktif';

        Karyawan::create($validated);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $karyawan = Karyawan::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        return view('karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, string $id)
    {
        $karyawan = Karyawan::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'departemen' => 'required|string|max:255',
            'detail_jabatan' => 'required|string|max:255',
            'edukasi' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'no_telepon' => 'required|string|max:20',
        ]);

        $karyawan->update($validated);

        return redirect()->route('karyawan.index')
                        ->with('success', 'Data karyawan berhasil diperbarui.');
    }
}
