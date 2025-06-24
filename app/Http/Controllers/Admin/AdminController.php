<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
            'role_filter' => 'nullable|string',
            'sort' => 'nullable|in:name,email,role_id',
            'direction' => 'nullable|in:asc,desc',
        ]);

        $search = $validated['search'] ?? null;
        $roleFilter = $validated['role_filter'] ?? null;
        $sortField = $validated['sort'] ?? 'name';
        $sortDirection = $validated['direction'] ?? 'asc';

        // Base query
        $query = User::query()
            ->with('role')
            ->where(function($q) {
                $q->whereDoesntHave('role', function (Builder $query) {
                    $query->where('name', 'admin');
                })->orWhereNull('role_id');
            });

        // Search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
            });
        }

        // Role filter
        if ($roleFilter) {
            $query->whereHas('role', function (Builder $q) use ($roleFilter) {
                $q->where('slug', $roleFilter);
            });
        }

        // Sorting
        $query->orderBy($sortField, $sortDirection);

        $users = $query->paginate(10)->withQueryString();

        return view('admin.index', [
            'users' => $users,
            'roles' => Role::where('name', '!=', 'admin')->get(),
            'filters' => [
                'search' => $search,
                'role_filter' => $roleFilter,
                'sort' => $sortField,
                'direction' => $sortDirection,
            ],
        ]);
    }

    public function update(Request $request, User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->back()
                ->with('error', 'Cannot modify admin user');
        }

        $validated = $request->validate([
            'role_id' => 'nullable|integer|exists:roles,id',
        ]);

        try {
            if (isset($validated['role_id'])) {
                $selectedRole = Role::findOrFail($validated['role_id']);
                if ($selectedRole->name === 'admin') {
                    return redirect()->back()
                        ->with('error', 'Cannot assign admin role');
                }
                $user->role_id = $validated['role_id'];
            } else {
                $user->role_id = null;
            }

            $user->save();

            return redirect()->back()
                ->with('success', 'Role updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update role: ' . $e->getMessage());
        }
    }
}
