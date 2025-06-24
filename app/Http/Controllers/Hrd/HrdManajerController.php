<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Manajer;
use Illuminate\Http\Request;

class HrdManajerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:hrd']);
    }

    public function index(Request $request)
    {
        $query = Manajer::with(['user.role']);

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

        $manajers = $query->paginate(10)->withQueryString();

        return view('hrd.manajer.index', compact('manajers'));
    }

    public function show(string $id)
    {
        $manajer = Manajer::with(['user.role'])
                   ->findOrFail($id);

        return view('hrd.manajer.show', compact('manajer'));
    }

    public function create()
    {
        return view('hrd.manajer.create');
    }

    public function store(Request $request)
    {
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

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'Aktif';

        $created = Manajer::create($validated);

        return redirect()->route('hrd.manajer.show', $created->id)
                 ->with('success', 'Data manajer berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $manajer = Manajer::with(['user.role'])
                   ->findOrFail($id);

        return view('hrd.manajer.edit', compact('manajer'));
    }

    public function update(Request $request, string $id)
    {
        $manajer = Manajer::findOrFail($id);

        $validated = $request->validate([
            'nip' => 'required|string|unique:manajers,nip,'.$id,
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

        return redirect()->route('hrd.manajer.index')
                        ->with('success', 'Data manajer berhasil diperbarui.');
    }

    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:Aktif,Non-Aktif',
        ]);

        $manajer = Manajer::findOrFail($id);
        $manajer->status = $request->status;
        $manajer->save();

        return back()->with('success', 'Status manajer diperbarui.');
    }

    public function destroy(string $id)
    {
        $manajer = Manajer::findOrFail($id);

        if ($manajer->user) {
            $manajer->user->delete();
        }

        $manajer->delete();

        return redirect()->route('hrd.manajer.index')
                         ->with('success', 'Manajer berhasil dihapus.');
    }
}
