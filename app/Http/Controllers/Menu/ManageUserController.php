<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    // ====================== VIEW ======================
    public function index()
    {
        $data = [
            'data' => User::where('role', '!=', 0)->select('id', 'name', 'email', 'username', 'role', 'last_login_at')->get(),
            'title' => 'Kelola User',
            'subtitle' => 'Daftar User',
        ];
        return view('page.kelolauser.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User',
            'subtitle' => 'Tambah User Baru',
        ];
        return view('page.kelolauser.create', $data);
    }
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            flashError('User tidak ditemukan.');
            return redirect()->back();
        }

        $data = [
            'user' => $user,
            'title' => 'Edit User',
            'subtitle' => 'Edit User ' . $user->name,
        ];
        return view('page.kelolauser.update', $data);
    }
    // ====================== END VIEW ======================

    // ====================== ACTION ======================
    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'fullname' => 'required|string|max:255',
                    'username' => 'required|string|max:255|unique:users,username',
                    'email' => 'required|string|email|max:255|unique:users,email',
                    'password' => 'required|string|min:8|confirmed',
                    'role' => 'required|integer|in:1,2,3,4',
                ],
                [
                    'fullname.required' => 'Nama wajib diisi.',
                    'username.required' => 'Username wajib diisi.',
                    'username.unique' => 'Username sudah digunakan.',
                    'email.required' => 'Email wajib diisi.',
                    'email.email' => 'Format email tidak valid.',
                    'email.unique' => 'Email sudah digunakan.',
                    'password.required' => 'Password wajib diisi.',
                    'password.min' => 'Password minimal 8 karakter.',
                    'password.confirmed' => 'Konfirmasi password tidak sesuai.',
                    'role.required' => 'Role wajib dipilih.',
                    'role.in' => 'Role tidak valid.',
                ]
            );

            User::create([
                'name' => $request->fullname,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
            ]);

            flashSuccess('User berhasil ditambahkan.');
            return redirect()->route('kelolauser.index');
        } catch (\Throwable $th) {
            flashError('Terjadi kesalahan saat menambahkan user: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::where('id', $id)->first();
            if (!$user) {
                flashError('User tidak ditemukan.');
                return redirect()->back();
            }

            $request->validate(
                [
                    'fullname' => 'required|string|max:255',
                    'username' => 'required|string|max:255|unique:users,username,' . $user->id,
                    'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                    'role' => 'required|integer|in:1,2,3,4',
                ],
                [
                    'fullname.required' => 'Nama wajib diisi.',
                    'username.required' => 'Username wajib diisi.',
                    'username.unique' => 'Username sudah digunakan.',
                    'email.required' => 'Email wajib diisi.',
                    'email.email' => 'Format email tidak valid.',
                    'email.unique' => 'Email sudah digunakan.',
                    'role.required' => 'Role wajib dipilih.',
                    'role.in' => 'Role tidak valid.',
                ]
            );

            $user->update([
                'name' => $request->fullname,
                'username' => $request->username,
                'email' => $request->email,
                'role' => $request->role,
            ]);

            flashSuccess('User berhasil diperbarui.');
            return redirect()->route('kelolauser.index');
        } catch (\Throwable $th) {
            flashError('Terjadi kesalahan saat memperbarui user: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::where('id', $id)->first();
            if (!$user) {
                flashError('User tidak ditemukan.');
                return redirect()->back();
            }

            $user->delete();

            flashSuccess('User berhasil dihapus.');
            return redirect()->route('kelolauser.index');
        } catch (\Throwable $th) {
            flashError('Terjadi kesalahan saat menghapus user: ' . $th->getMessage());
            return redirect()->back();
        }
    }
}    // ====================== END ACTION ======================
