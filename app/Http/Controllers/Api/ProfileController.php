<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function completeProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|max:255|unique:karyawans,nip',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'departemen' => 'required|string',
            'detail_jabatan' => 'required|string',
            'edukasi' => 'required|string',
            'gender' => 'required|string|in:male,female',
            'no_telepon' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        if (Karyawan::where('user_id', auth()->id())->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Profile already exists'
            ], 409);
        }

        $karyawan = Karyawan::create([
            'user_id' => auth()->id(),
            'nip' => $request->nip,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'departemen' => $request->departemen,
            'status' => 'Aktif', // Di-set otomatis sebagai 'Aktif'
            'detail_jabatan' => $request->detail_jabatan,
            'edukasi' => $request->edukasi,
            'gender' => $request->gender,
            'no_telepon' => $request->no_telepon,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Profile completed successfully',
            'karyawan' => $karyawan
        ], 201);
    }
}
