<div class="mb-3 form-role-user">
    <label for="role" class="form-label">Role User</label>
    <select id="role" class="form-select" name="role">
        <option disabled {{ old('role', $user->role ?? '') == '' ? 'selected' : '' }}>Pilih Role User</option>
        <option value="1" {{ old('role', $user->role ?? '') == 1 ? 'selected' : '' }}>Staff</option>
        <option value="2" {{ old('role', $user->role ?? '') == 2 ? 'selected' : '' }}>Petugas Arsip</option>
        <option value="3" {{ old('role', $user->role ?? '') == 3 ? 'selected' : '' }}>Kepala Subseksi</option>
        <option value="4" {{ old('role', $user->role ?? '') == 4 ? 'selected' : '' }}>Kepala Seksi</option>
    </select>
    @error('role')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="fullname">Nama Lengkap</label>
    <div class="input-group input-group-merge">
        <span id="fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="John Doe"
            value="{{ old('fullname', $user->name ?? '') }}" />
    </div>
    @error('fullname')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="username">Username</label>
    <div class="input-group input-group-merge">
        <span class="input-group-text"><i class="bx bx-user"></i></span>
        <input type="text" id="username" class="form-control" name="username" placeholder="jhondoe2"
            value="{{ old('username', $user->username ?? '') }}" />
    </div>
    @error('username')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="email">Email</label>
    <div class="input-group input-group-merge">
        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
        <input type="text" id="email" class="form-control" name="email" placeholder="john.doe"
            value="{{ old('email', $user->email ?? '') }}" />
        <span id="email2" class="input-group-text">@example.com</span>
    </div>
    @error('email')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3 form-password-toggle">
    <label class="form-label" for="password">Password</label>
    <div class="input-group input-group-merge">
        <span class="input-group-text"><i class="bx bx-lock"></i></span>
        <input type="password" id="password" class="form-control" name="password" placeholder="••••••••••" />
        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
    </div>
    @if (isset($user))
        <div class="form-text">Kamu bisa merubah password kamu disini</div>
    @endif
    @error('password')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3 form-password-toggle">
    <label class="form-label" for="password_confirmation">Confirm Password</label>
    <div class="input-group input-group-merge">
        <span class="input-group-text"><i class="bx bx-lock"></i></span>
        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
            placeholder="••••••••••" />
        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
    </div>
    @error('password_confirmation')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>