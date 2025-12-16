@extends('layout.body', ['title' => $title])

@include('layout.datatable')

@section('content')
<x-arsip-tabs active="kategori" />


<div class="d-flex justify-content-between align-items-center">
    <x-head-index :title="$title" />
    <x-btn-add :href="route('arsip.kategori.create')" title="Tambah Kategori" />
</div>


<div class="card">
    <div class="table-responsive p-4 text-nowrap">
        <h4 class="fw-bold py-3 mb-4">{{ $subtitle }}</h4>
        <table class="table" id="datatable">
            <thead class="table-dark">
                <tr>
                    <th class="text-white" style="width: 10px;">#</th>
                    <th class="text-white" style="width: 350px;">Nama</th>
                    <th class="text-white text-wrap">Deskripsi</th>
                    <th class="text-white" style="width: 50px;">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($kategori as $item)
                <tr>
                    <td class="text-center"><strong>{{ $loop->iteration }}</strong></td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <x-description :id="$item->id" :title="$item->name" :text="$item->description"
                            limit="60" />
                    </td>

                    <td class="text-center">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('arsip.kategori.edit', $item->id) }}"><i
                                        class="bx bx-edit-alt me-1"></i>
                                    Edit</a>

                                <x-delete id="deleteKategori{{ $item->id }}"
                                    action="{{ route('arsip.kategori.destroy', $item->id) }}"
                                    message="Yakin ingin menghapus kategori ini?" />
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection