@extends('layout.body', ['title' => $title])

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> {{ $title }}</h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $subtitle }}</h5>
                    {{-- <small class="text-muted float-end">Merged input group</small> --}}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('arsip.kategori.store') }}">
                        @csrf

                        @include('page.arsip.kategori._forms')

                        <x-btn-input :href="route('arsip.kategori.index')" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection