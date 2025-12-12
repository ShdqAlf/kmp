@extends('layout.body', ['title' => $title])

@include('layout.datatable')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <x-head-index :title="$title" />
        <x-btn-add :href="route('divisi.create')" title="Tambah Divisi" />
    </div>


    <div class="card">
        <div class="table-responsive p-4 text-nowrap">
            <h4 class="fw-bold py-3 mb-4">{{ $subtitle }}</h4>
            <table class="table" id="datatable">
                <thead class="table-dark">
                    <tr>
                        <th class="text-white" style="width: 10px;">#</th>
                        <th class="text-white">Nama</th>
                        <th class="text-white text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($divisi as $item)
                        <tr>
                            <td class="text-center"><strong>{{ $loop->iteration }}</strong></td>
                            <td>{{ $item->name }}</td>

                            <td class="text-center">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('divisi.edit', $item->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>

                                        <x-delete id="deleteDivisi{{ $item->id }}"
                                            action="{{ route('divisi.destroy', $item->id) }}"
                                            message="Yakin ingin menghapus divisi ini?" />
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