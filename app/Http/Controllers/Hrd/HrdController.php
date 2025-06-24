<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Hrd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HrdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:hrd');
    }

    public function index()
    {
        $hrd = HRD::with(['user.role'])
                ->where('user_id', Auth::id())
                ->first();

        if (!$hrd) {
            return redirect()->route('hrd.create')->with('error', 'Silakan lengkapi data HRD Anda terlebih dahulu.');
        }

        return view('hrd.index', compact('hrd'));
    }

    public function create()
    {
        return view('hrd.create');
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        if (HRD::where('user_id', $userId)->exists()) {
            return redirect()->route('hrd.index')->with('error', 'Data HRD sudah ada.');
        }

        $validated = $request->validate([
            'nip' => 'required|string|unique:hrds,nip',
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

        HRD::create($validated);

        return redirect()->route('hrd.index')->with('success', 'Data HRD berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $hrd = HRD::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        return view('hrd.edit', compact('hrd'));
    }

    public function update(Request $request, string $id)
    {
        $hrd = HRD::where('id', $id)
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

        $hrd->update($validated);

        return redirect()->route('hrd.index')
                        ->with('success', 'Data HRD berhasil diperbarui.');
    }
}
