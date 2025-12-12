@props([
    'id',          
    'title',       
    'text' => '',  
    'limit' => 50, 
])

@php
    use Illuminate\Support\Str;
@endphp

<a href="#" 
   data-bs-toggle="modal" 
   data-bs-target="#descModal{{ $id }}"
   class="text-decoration-underline"
   style="cursor: pointer;">
    {{ Str::limit($text, $limit) }}
</a>

<div class="modal fade" id="descModal{{ $id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Deskripsi: {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                @if ($text)
                    <p class="mb-0 desc-modal-text">{{ $text }}</p>
                @else
                    <p class="text-muted fst-italic mb-0">Tidak ada deskripsi...</p>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>
