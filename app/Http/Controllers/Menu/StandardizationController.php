<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Standardization;
use Illuminate\Http\Request;

class StandardizationController extends Controller
{
    // =============== VIEW ===============

    public function index()
    {
        $standarisasi = Standardization::select('id', 'name', 'description')->get();

        $data = [
            'title' => 'Standarisasi',
            'subtitle' => 'Daftar Standarisasi',
            'standarisasi' => $standarisasi,
        ];
        return view('page.arsip.standarisasi.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Standarisasi',
            'subtitle' => 'Tambah Standarisasi Baru',
        ];
        return view('page.arsip.standarisasi.create', $data);
    }

    public function edit($id)
    {
        $standarisasi = Standardization::find($id);
        if (!$standarisasi) {
            flashError('Standarisasi tidak ditemukan.');
            return redirect()->back();
        }

        $data = [
            'title' => 'Edit Standarisasi',
            'subtitle' => 'Edit Standarisasi',
            'standarisasi' => $standarisasi,
        ];
        return view('page.arsip.standarisasi.update', $data);
    }

    // =============== END VIEW ===============

    // =============== ACTION ===============

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:standardizations,name',
                'description' => 'nullable|string|max:1000',
            ], [
                'name.required' => 'Nama standarisasi wajib diisi.',
                'name.unique' => 'Nama standarisasi sudah ada.',
            ]);

            Standardization::create($request->all());
            flashSuccess('Standarisasi berhasil ditambahkan.');
            return redirect()->route('arsip.standarisasi.index');
        } catch (\Exception $e) {
            flashError('Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $standarisasi = Standardization::findOrFail($id);
            
            if (!$standarisasi) {
                flashError('Standarisasi tidak ditemukan.');
                return redirect()->back();
            }

            $request->validate([
                'name' => 'required|string|max:255|unique:standardizations,name,' . $standarisasi->id,
                'description' => 'nullable|string|max:1000',
            ], [
                'name.required' => 'Nama standarisasi wajib diisi.',
                'name.unique' => 'Nama standarisasi sudah ada.',
            ]);

            $standarisasi->update($request->all());
            flashSuccess('Standarisasi berhasil diperbarui.');
            return redirect()->route('arsip.standarisasi.index');
        } catch (\Exception $e) {
            flashError('Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $standarisasi = Standardization::findOrFail($id);
            if (!$standarisasi) {
                flashError('Standarisasi tidak ditemukan.');
                return redirect()->back();
            }
            $standarisasi->delete();
            flashSuccess('Standarisasi berhasil dihapus.');
            return redirect()->route('arsip.standarisasi.index');
        } catch (\Exception $e) {
            flashError('Terjadi kesalahan saat menghapus: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    // =============== END ACTION ===============
}
