<div class="mb-3">
    <label class="form-label" for="title">Judul Arsip</label>
    <div class="input-group input-group-merge">
        <span id="name-addon" class="input-group-text">
            <i class="bx bx-label"></i>
        </span>
        <input type="text" id="title" name="title" class="form-control" placeholder="Judul Arsip"
            aria-describedby="title-addon" value="{{ old('title', $archives->title ?? '') }}">
    </div>
    @error('title')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- Divisi -->
<div class="mb-3">
    <label class="form-label" for="division">Divisi</label>
    <select id="division" name="division" class="form-select">
        @foreach ($division as $div)
        <option value="{{ $div->id }}" {{ old('division', $archives->division_id ?? '') == $div->id ? 'selected' : '' }}>
            {{ $div->name }}
        </option>
        @endforeach
    </select>
    @error('division')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<!-- Tipe Arsip -->
<div class="mb-3">
    <label class="form-label" for="archive_type">Tipe Arsip</label>
    <select id="archive_type" name="archive_type" class="form-select">
        @foreach ($types as $type)
        <option value="{{ $type->id }}" {{ old('archive_type', $archives->archive_type ?? '') == $type->id ? 'selected' : '' }}>
            {{ $type->name }}
        </option>
        @endforeach
    </select>
    @error('archive_type')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- Standarisasi -->
<div class="mb-3">
    <label class="form-label" for="standardization">Standarisasi</label>
    <select id="standardization" name="standardization" class="form-select">
        @foreach ($standardizations as $standardization)
        <option value="{{ $standardization->id }}" {{ old('standardization', $archives->standardization ?? '') == $standardization->id ? 'selected' : '' }}>
            {{ $standardization->name }}
        </option>
        @endforeach
    </select>
    @error('standardization')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- Tanggal Arsip -->
<div class="mb-3">
    <label class="form-label" for="archive_date">Tanggal Arsip</label>
    <input type="date" id="archive_date" name="archive_date" class="form-control"
        value="{{ old('date', $archives->date ?? '') }}">
    @error('archive_date')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- Upload File -->
<div class="mb-3">
    <label class="form-label" for="files">Upload File</label>
    <input type="file" id="files" name="files[]" class="form-control" multiple>
    @error('files')
    <small class="text-danger">{{ $message }}</small>
    @enderror
    <!-- Drag and Drop Area -->
    <div class="file-drop-area" style="border: 2px dashed #ccc; padding: 20px; text-align: center;">
        <p>Drag & Drop files here or click to select files</p>
    </div>
</div>