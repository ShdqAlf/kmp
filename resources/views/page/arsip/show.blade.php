@extends('layout.body', ['title' => $title])

@section('content')
<h4 class="fw-bold py-3 mb-4">{{ $subtitle }}</h4>

<div class="card">
    <div class="card-body">
        <p><strong>Judul:</strong> {{ $archive->title }}</p>
        <p><strong>Divisi:</strong> {{ $archive->division->name }}</p>
        <p><strong>Kategori:</strong> {{ $archive->type->category->name }}</p>
        <p><strong>Tipe:</strong> {{ $archive->type->name }}</p>
        <p><strong>Standarisasi:</strong> {{ $archive->standardization->name }}</p>
        <p><strong>Tanggal Arsip:</strong> {{ $archive->date }}</p>

        <div>
            <strong>File Arsip:</strong>
            <ul>
                @foreach($archive->documents as $document)
                <li>
                    <a href="{{ Storage::url($document->file_path) }}" download="{{ $document->title }}" target="_blank">
                        {{ $document->title }}
                    </a>

                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection