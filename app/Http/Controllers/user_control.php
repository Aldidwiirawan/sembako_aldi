<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class user_control extends Controller
{
    // ========================= REGISTER ============================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => 'pembeli', // default pembeli
        ]);

        // Setelah register berhasil → redirect ke login
        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    // ========================= PROFILE ============================
    public function profile(Request $request)
    {
        $user = Auth::user();
        $dataTransaksi = Transaction::where('user_id', $user->id)->with('details')->get();

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|min:6',
                'alamat' => 'required|string|max:255',
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->alamat = $request->alamat;

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = 'user_' . $user->id . '.' . $file->getClientOriginalExtension();
                $path = 'images/' . $filename;

                if ($user->foto && file_exists(public_path($user->foto))) {
                    unlink(public_path($user->foto));
                }

                $file->move(public_path('images'), $filename);
                $user->foto = $path;
            }

            $user->save();
            return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
        }

        return view('profile', compact('user', 'dataTransaksi'));
    }

    // ========================= VIEW DATA USER ============================
    public function index()
    {
        $dataPembeli = User::where('usertype', 'pembeli')->get();
        $dataAdmin = User::where('usertype', 'admin')->get();

        return view('dashboard_owner.user.index', compact('dataPembeli', 'dataAdmin'));
    }

    // ========================= LOGIN ============================
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            // Arahkan berdasarkan usertype
            switch ($user->usertype) {
                case 'admin':
                    return redirect('/admin');
                case 'owner':
                    return redirect('/owner');
                case 'pembeli':
                    return redirect('/order');
                default:
                    Auth::logout();
                    return back()->withErrors(['login' => 'Usertype tidak dikenal.']);
            }
        }

        return back()->withErrors(['login' => 'Email atau password salah!'])->withInput();
    }

    // ========================= LOGOUT ============================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
