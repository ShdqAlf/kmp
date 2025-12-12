<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    // ============== VIEW ==============
    public function index()
    {
        $kategori = Categories::select('id', 'name', 'description')->get();
        $data = [
            'title' => 'Kategori Arsip',
            'kategori' => $kategori,
            'subtitle' => 'Daftar Kategori Arsip',
        ];
        return view('page.arsip.kategori.index', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah Kategori',
            'subtitle' => 'Tambah Kategori Arsip Baru',
        ];
        return view('page.arsip.kategori.create', $data);
    }

    public function edit($id)
    {
        $category = Categories::find($id);
        if (!$category) {
            flashError('Kategori tidak ditemukan.');
            return redirect()->back();
        }

        $data = [
            'title' => 'Edit Kategori',
            'subtitle' => 'Edit Kategori Arsip',
            'kategori' => $category,
        ];
        return view('page.arsip.kategori.update', $data);
    }

    // ============== END VIEW ==============

    // ============== ACTION ==============
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
                'description' => 'nullable|string|max:1000',
            ], [
                'name.required' => 'Nama kategori wajib diisi.',
                'name.unique' => 'Nama kategori sudah ada.',
            ]);
            Categories::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            flashSuccess('Kategori berhasil ditambahkan.');
            return redirect()->route('arsip.kategori.index');
        } catch (\Throwable $th) {
            flashError('Terjadi kesalahan saat menambahkan kategori: ' . $th->getMessage());
            return redirect()->route('arsip.kategori.index');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Categories::find($id);
            if (!$category) {
                flashError('Kategori tidak ditemukan.');
                return redirect()->back();
            }

            $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $id,
                'description' => 'nullable|string|max:1000',
            ], [
                'name.required' => 'Nama kategori wajib diisi.',
                'name.unique' => 'Nama kategori sudah ada.',
            ]);

            $category->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            flashSuccess('Kategori berhasil diperbarui.');
            return redirect()->route('arsip.kategori.index');
        } catch (\Throwable $th) {
            flashError('Terjadi kesalahan saat memperbarui kategori: ' . $th->getMessage());
            return redirect()->route('arsip.kategori.index');
        }
    }

    public function destroy($id)
    {
        try {
            $category = Categories::find($id);
            if (!$category) {
                flashError('Kategori tidak ditemukan.');
                return redirect()->back();
            }

            $category->delete();
            flashSuccess('Kategori berhasil dihapus.');
            return redirect()->route('arsip.kategori.index');
        } catch (\Throwable $th) {
            flashError('Terjadi kesalahan saat menghapus kategori: ' . $th->getMessage());
            return redirect()->back();
        }
    }

    // ============== END ACTION ==============
}
