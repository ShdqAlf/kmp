<div class="mb-3">
    <label class="form-label" for="name">Nama</label>
    <div class="input-group input-group-merge">
        <span id="name-addon" class="input-group-text">
            <i class="bx bx-department"></i>
        </span>
        <input type="text" id="name" name="name" class="form-control" placeholder="Nama Divisi"
            aria-describedby="name-addon" value="{{ old('name', $divisi->name ?? '') }}">
    </div>
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
