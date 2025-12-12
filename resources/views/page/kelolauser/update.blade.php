@extends('layout.body', ['title' => $title])

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> {{ $title }}</h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $subtitle }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('kelolauser.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        @include('page.kelolauser._forms')

                        <x-btn-input :href="route('kelolauser.index')" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection