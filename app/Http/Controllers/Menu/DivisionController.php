<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    // =============== VIEW ===============

    public function index()
    {
        $divisi = Division::select('id', 'name')->get();
        
        $data = [
            'title' => 'Divisi',
            'subtitle' => 'Daftar Divisi',
            'divisi' => $divisi,
        ];
        return view('page.divisi.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Divisi',
            'subtitle' => 'Tambah Divisi Baru',
        ];
        return view('page.divisi.create', $data);
    }


    public function edit($id)
    {
        $divisi = Division::find($id);
        
        if (!$divisi) {
            flashError('Divisi tidak ditemukan.');
            return redirect()->back();
        }

        $data = [
            'title' => 'Edit Divisi',
            'subtitle' => 'Edit Divisi',
            'divisi' => $divisi,
        ];
        return view('page.divisi.update', $data);
    }

    // =============== END VIEW ===============

    // =============== ACTION ===============

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:divisions,name',
            ], [
                'name.required' => 'Nama divisi wajib diisi.',
                'name.unique' => 'Nama divisi sudah ada.',
            ]);

            Division::create($request->all());
            flashSuccess('Divisi berhasil ditambahkan.');
            return redirect()->route('divisi.index');
        } catch (\Exception $e) {
            flashError('Gagal menambahkan divisi: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $divisi = Division::findOrFail($id);
            if (!$divisi) {
                flashError('Divisi tidak ditemukan.');
                return redirect()->back();
            }
            $request->validate([
                'name' => 'required|string|max:255|unique:divisions,name,' . $divisi->id,
            ], [
                'name.required' => 'Nama divisi wajib diisi.',
                'name.unique' => 'Nama divisi sudah ada.',
            ]);

            $divisi->update($request->all());
            flashSuccess('Divisi berhasil diperbarui.');
            return redirect()->route('divisi.index');
        } catch (\Exception $e) {
            flashError('Gagal memperbarui divisi: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $divisi = Division::findOrFail($id);
            if (!$divisi) {
                flashError('Divisi tidak ditemukan.');
                return redirect()->back();
            }
            $divisi->delete();
            flashSuccess('Divisi berhasil dihapus.');
            return redirect()->route('divisi.index');
        } catch (\Exception $e) {
            flashError('Gagal menghapus divisi: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    // =============== END ACTION ===============
}
