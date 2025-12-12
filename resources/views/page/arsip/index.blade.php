@extends('layout.body', ['title' => $title])

@include('layout.datatable')

@section('content')

    <x-arsip-tabs active="arsip" />


    <div class="d-flex justify-content-between align-items-center">
        <x-head-index :title="$title" />
        <x-btn-add :href="route('arsip.create')" title="Tambah Arsip" />
    </div>

    <div class="d-flex justify-content-end mb-3">
        <div class="input-group" style="width: 280px;">
            <span class="input-group-text bg-white border-end-0">
                <i class="bx bx-search fs-5"></i>
            </span>
            <input type="text" id="kmp-search" class="form-control border-start-0" placeholder="Cari arsip...">
        </div>
    </div>


    <div class="card">
        <div class="table-responsive p-4 text-nowrap">
            <h4 class="fw-bold py-3 mb-4">{{ $subtitle }}</h4>
            <table class="table" id="datatable-arsip">
                <thead class="table-dark">
                    <tr>
                        <th class="text-white">#</th>
                        <th class="text-white">Judul</th>
                        <th class="text-white">Divisi</th>
                        <th class="text-white">Kategori</th>
                        <th class="text-white">Tipe</th>
                        <th class="text-white">Standarisasi</th>
                        <th class="text-white">Tanggal Arsip</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                </tbody>
            </table>
        </div>
    </div>

@endsection