<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class ManajerKaryawanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:manajer']);
    }

    public function index(Request $request)
    {
        $query = Karyawan::with(['user.role']);

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'ilike', '%'.$searchTerm.'%')
                  ->orWhere('nip', 'ilike', '%'.$searchTerm.'%')
                  ->orWhere('departemen', 'ilike', '%'.$searchTerm.'%');
            });
        }

        if ($request->has('status_filter') && !empty($request->status_filter)) {
            $status = $request->status_filter;
            if ($status === 'aktif') {
                $query->where('status', 'Aktif');
            } elseif ($status === 'non-aktif') {
                $query->where('status', 'Non-Aktif');
            }
        }

        $sortField = $request->get('sort', 'nama');
        $sortDirection = $request->get('direction', 'asc');

        $allowedSortFields = ['nip', 'nama', 'departemen', 'detail_jabatan', 'status'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'nama';
        }

        $query->orderBy($sortField, $sortDirection);

        $karyawans = $query->paginate(10)->withQueryString();

        return view('manajer.karyawan.index', compact('karyawans'));
    }

    public function show(string $id)
    {
        $karyawan = Karyawan::with(['user.role'])
                   ->findOrFail($id);

        return view('manajer.karyawan.show', compact('karyawan'));
    }

    public function create()
    {
        return view('manajer.karyawan.create');
    }

    public function store(Request $request)
    {
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

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'Aktif';

        $created = Karyawan::create($validated);

        return redirect()->route('manajer.karyawan.show', $created->id)
                 ->with('success', 'Data karyawan berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $karyawan = Karyawan::with(['user.role'])
                   ->findOrFail($id);

        return view('manajer.karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, string $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $validated = $request->validate([
            'nip' => 'required|string|unique:karyawans,nip,'.$id,
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

        return redirect()->route('manajer.karyawan.index')
                        ->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:Aktif,Non-Aktif',
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->status = $request->status;
        $karyawan->save();

        return back()->with('success', 'Status karyawan diperbarui.');
    }

    public function destroy(string $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        if ($karyawan->user) {
            $karyawan->user->delete();
        }

        $karyawan->delete();

        return redirect()->route('manajer.karyawan.index')
                         ->with('success', 'Karyawan berhasil dihapus.');
    }
}
