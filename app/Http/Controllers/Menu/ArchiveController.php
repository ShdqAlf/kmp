<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Standardization;
use App\Models\Division;
use App\Models\Archive;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    public function index()
    {
        // Mengambil data arsip beserta relasinya
        $archives = Archive::with(['division', 'type', 'standardization'])->get();

        $data = [
            'title' => 'Arsip',
            'subtitle' => 'Daftar Arsip',
            'archives' => $archives,  // Mengirim data arsip ke view
        ];

        return view('page.arsip.index', $data);
    }


    public function create()
    {
        $types = Type::all();
        $standardizations = Standardization::all();
        $division = Division::all();

        $data = [
            'title' => 'Tambah Arsip',
            'subtitle' => 'Tambah Arsip Baru',
            'types' => $types,
            'standardizations' => $standardizations,
            'division' => $division,
        ];

        return view('page.arsip.create', $data);
    }

    // Method untuk menyimpan data arsip
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'division' => 'required|exists:divisions,id',
            'archive_type' => 'required|exists:types,id',
            'standardization' => 'required|exists:standardizations,id',
            'archive_date' => 'required|date',
            'files' => 'nullable|array',
        ]);

        // Menyimpan data arsip
        $archive = Archive::create([
            'standardization_id' => $validatedData['standardization'],
            'user_id' => auth()->id(), // Pastikan sudah login
            'division_id' => $validatedData['division'],
            'type_id' => $validatedData['archive_type'],
            'title' => $validatedData['title'],
            'date' => $validatedData['archive_date'],
        ]);

        // Menyimpan file jika ada
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filePath = $file->storeAs('documents', $file->getClientOriginalName());
                Document::create([
                    'archive_id' => $archive->id,
                    'title' => $file->getClientOriginalName(),
                    'file_path' => $filePath,
                ]);
            }
        }

        // Redirect atau beri respon sukses
        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil ditambahkan.');
    }

    public function show($id)
    {
        $archive = Archive::with(['division', 'type', 'standardization'])->findOrFail($id);

        $data = [
            'title' => 'Detail Arsip',
            'subtitle' => 'Informasi Arsip',
            'archive' => $archive,
        ];

        return view('page.arsip.show', $data);
    }

    public function destroy($id)
    {
        // Cari arsip berdasarkan ID
        $archive = Archive::findOrFail($id);

        // Hapus arsip
        $archive->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil dihapus.');
    }


    public function edit($id)
    {
        // Ambil data arsip beserta relasi yang diperlukan
        $archive = Archive::with(['division', 'type', 'standardization'])->findOrFail($id);
        $types = Type::all();
        $standardizations = Standardization::all();
        $division = Division::all();

        $data = [
            'title' => 'Edit Arsip',
            'subtitle' => 'Edit Arsip',
            'archive' => $archive,
            'types' => $types,
            'standardizations' => $standardizations,
            'division' => $division,
        ];

        return view('page.arsip.update', $data); // Pastikan file view ada di page/arsip/edit.blade.php
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'division' => 'required|exists:divisions,id',
            'archive_type' => 'required|exists:types,id',
            'standardization' => 'required|exists:standardizations,id',
            'archive_date' => 'required|date',
            'files' => 'nullable|array',
        ]);

        // Cari arsip yang akan diupdate
        $archive = Archive::findOrFail($id);
        $archive->update([
            'title' => $validatedData['title'],
            'division_id' => $validatedData['division'],
            'type_id' => $validatedData['archive_type'],
            'standardization_id' => $validatedData['standardization'],
            'date' => $validatedData['archive_date'],
        ]);

        // Menyimpan file baru jika ada
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filePath = $file->storeAs('documents', $file->getClientOriginalName());
                Document::create([
                    'archive_id' => $archive->id,
                    'title' => $file->getClientOriginalName(),
                    'file_path' => $filePath,
                ]);
            }
        }

        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil diperbarui.');
    }
}
