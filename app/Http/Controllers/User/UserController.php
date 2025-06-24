<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Role;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role->name === 'user') {
            $absensi = Absensi::where('user_id', auth()->id())->get();
            return view('absensi.index', compact('absensi'));
        }

        $query = User::with('role');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($role = $request->input('role')) {
            $query->where('role_id', $role);
        }

        if ($sort = $request->input('sort')) {
            $query->orderBy($sort);
        }

        $users = $query->paginate(10);
        $roles = Role::all();

        return view('users.index', compact('users', 'roles'));
    }

    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        $roles = Role::where('name', '!=', 'admin')->get(); // Exclude admin
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'nullable|exists:roles,id'
        ]);

        if ($request->has('role_id')) {
            $selectedRole = Role::find($request->role_id);
            if ($selectedRole && $selectedRole->name === 'admin') {
                return redirect()->back()->with('error', 'Cannot assign admin role');
            }

            $user->role_id = $validated['role_id'];
        }

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id'] ?? $user->role_id
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function resetPassword(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $newPassword = 'password'; // Gunakan yang lebih aman di production

        $user->update([
            'password' => Hash::make($newPassword)
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Password reset successfully. New password is: ' . $newPassword);
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    public function first()
    {
        $user = User::first();

        if ($user) {
            return response()->json([
                'id' => $user->id,
                'nama' => $user->name,
            ]);
        } else {
            return response()->json([
                'message' => 'User tidak ditemukan'
            ], 404);
        }
    }
}
