<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users with filtering options
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by role
        if ($request->has('role') && $request->role && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->has('status') && $request->status && $request->status !== 'all') {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } else if ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Search by name or email
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'like', "%{$searchTerm}%")
                  ->orWhere('email', 'like', "%{$searchTerm}%")
                  ->orWhere('nomor_telepon', 'like', "%{$searchTerm}%");
            });
        }

        // Order by newest first
        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        // Get statistics for dashboard cards
        $totalUsers = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $kasirCount = User::where('role', 'kasir')->count();
        $penggunaCount = User::where('role', 'pengguna')->count();
        $activeUsers = User::where('is_active', true)->count();
        $inactiveUsers = User::where('is_active', false)->count();

        return view('admin.user-management', compact(
            'users',
            'totalUsers',
            'adminCount',
            'kasirCount',
            'penggunaCount',
            'activeUsers',
            'inactiveUsers'
        ));
    }

    /**
     * Update user role
     */
    public function updateRole(Request $request, $id)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'role' => 'required|in:admin,kasir,pengguna'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Role tidak valid.'
            ], 422);
        }

        // Find the user
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan.'
            ], 404);
        }

        // Prevent user from changing their own role
        if ($user->id === Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat mengubah role Anda sendiri.'
            ], 403);
        }

        // Update the user's role
        $oldRole = $user->role;
        $user->role = $request->role;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => "Role user {$user->nama} berhasil diubah dari {$oldRole} menjadi {$request->role}.",
            'user' => [
                'id' => $user->id,
                'nama' => $user->nama,
                'role' => $user->role
            ]
        ]);
    }

    /**
     * Toggle user active status
     */
    public function toggleStatus(Request $request, $id)
    {
        // Find the user
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan.'
            ], 404);
        }

        // Prevent user from deactivating themselves
        if ($user->id === Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat menonaktifkan akun Anda sendiri.'
            ], 403);
        }

        // Toggle the status
        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return response()->json([
            'success' => true,
            'message' => "User {$user->nama} berhasil {$status}.",
            'user' => [
                'id' => $user->id,
                'nama' => $user->nama,
                'is_active' => $user->is_active
            ]
        ]);
    }

    /**
     * Get user details
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->id,
                'nama' => $user->nama,
                'email' => $user->email,
                'nomor_telepon' => $user->nomor_telepon,
                'role' => $user->role,
                'is_active' => $user->is_active,
                'created_at' => $user->created_at->format('d/m/Y H:i'),
                'updated_at' => $user->updated_at->format('d/m/Y H:i')
            ]
        ]);
    }
}
