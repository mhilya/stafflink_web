<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manajer;

class ManajerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:manajer');
    }

    public function index()
    {
        $manajer = Manajer::with('user.role')
                ->where('user_id', auth()->id())
                ->first();

        if (!$manajer) {
            return redirect()->route('manajer.create')->with('error', 'Silakan lengkapi data manajer Anda terlebih dahulu.');
        }

        return view('manajer.index', compact('manajer'));
    }

    public function create()
    {
        return view('manajer.create');
    }

    public function store(Request $request)
    {
        $userId = auth()->id();

        if (Manajer::where('user_id', $userId)->exists()) {
            return redirect()->route('manajer.index')->with('error', 'Data manajer sudah ada.');
        }

        $validated = $request->validate([
            'nip' => 'required|string|unique:manajers,nip',
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

        Manajer::create($validated);

        return redirect()->route('manajer.index')->with('success', 'Data manajer berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $manajer = Manajer::where('id', $id)
                    ->where('user_id', auth()->id())
                    ->firstOrFail();

        return view('manajer.edit', compact('manajer'));
    }

    public function update(Request $request, string $id)
    {
        $manajer = Manajer::where('id', $id)
                    ->where('user_id', auth()->id())
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

        $manajer->update($validated);

        return redirect()->route('manajer.index')
                        ->with('success', 'Data manajer berhasil diperbarui.');
    }
}
