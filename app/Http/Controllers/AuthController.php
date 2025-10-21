<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Check if user is active
            if (!Auth::user()->is_active) {
                Auth::logout();
                return redirect()->back()->withErrors([
                    'email' => 'Akun Anda tidak aktif. Hubungi administrator.'
                ]);
            }

            // Redirect based on role
            $role = Auth::user()->role;

            switch ($role) {
                case 'admin':
                    return redirect()->intended('/admin/dashboard');
                case 'kasir':
                    return redirect()->intended('/kasir/dashboard');
                case 'pengguna':
                    return redirect()->intended('/pengguna/dashboard');
                default:
                    return redirect()->intended('/dashboard');
            }
        }

        return redirect()->back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    // Menampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'nama' => $request->nama,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pengguna', // Default role
            'is_active' => true,
        ]);

        Auth::login($user);

        // Redirect ke dashboard pengguna setelah register
        return redirect('/pengguna/dashboard')->with('success', 'Registrasi berhasil!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}
