<?php 

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    // =============== VIEW ===============
    public function index()
    {
        $tipe = Type::with('category')->select('id','name', 'description', 'category_id')->get();
        $data = [
            'title' => 'Tipe Arsip',
            'subtitle' => 'Daftar Tipe Arsip',
            'tipe' => $tipe,
        ];
        return view('page.arsip.tipe.index', $data);
    }

    public function create()
    {
        $kategori = Categories::select('id', 'name')->get();
        $data = [
            'title' => 'Tambah Tipe',
            'subtitle' => 'Tambah Tipe Arsip Baru',
            'kategori' => $kategori,
        ];
        return view('page.arsip.tipe.create', $data);
    }

    public function edit($id)
    {
        $tipe = Type::find($id);
        if (!$tipe) {
            flashError('Tipe tidak ditemukan.');
            return redirect()->back();
        }

        $kategori = Categories::select('id', 'name')->get();
        $data = [
            'title' => 'Edit Tipe',
            'subtitle' => 'Edit Tipe Arsip',
            'tipe' => $tipe,
            'kategori' => $kategori,
        ];
        return view('page.arsip.tipe.update', $data);
    }

    // =============== END VIEW ===============

    // =============== ACTION ===============

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:types,name',
                'description' => 'nullable|string|max:1000',
                'category_id' => 'required|exists:categories,id',
            ], [
                'name.required' => 'Nama tipe wajib diisi.',
                'name.unique' => 'Nama tipe sudah ada.',
                'category_id.required' => 'Kategori wajib dipilih.',
            ]);

            Type::create($request->all());
            flashSuccess('Tipe berhasil ditambahkan.');
            return redirect()->route('arsip.tipe.index');
        } catch (\Exception $e) {
            flashError('Gagal menambahkan tipe: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $tipe = Type::findOrFail($id);

            if (!$tipe) {
                flashError('Tipe tidak ditemukan.');
                return redirect()->back();
            }

            $request->validate([
                'name' => 'required|string|max:255|unique:types,name,' . $tipe->id,
                'description' => 'nullable|string|max:1000',
                'category_id' => 'required|exists:categories,id',
            ], [
                'name.required' => 'Nama tipe wajib diisi.',
                'name.unique' => 'Nama tipe sudah ada.',
                'category_id.required' => 'Kategori wajib dipilih.',
            ]);

            $tipe->update($request->all());
            flashSuccess('Tipe berhasil diperbarui.');
            return redirect()->route('arsip.tipe.index');
        } catch (\Exception $e) {
            flashError('Gagal memperbarui tipe: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $tipe = Type::findOrFail($id);

            if (!$tipe) {
                flashError('Tipe tidak ditemukan.');
                return redirect()->back();
            }
            
            $tipe->delete();
            flashSuccess('Tipe berhasil dihapus.');
            return redirect()->route('arsip.tipe.index');
        } catch (\Exception $e) {
            flashError('Gagal menghapus tipe: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    // =============== END ACTION ===============
}
