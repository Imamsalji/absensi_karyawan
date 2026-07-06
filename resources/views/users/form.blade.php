<div class="mb-3">

    <label class="form-label">
        Nama
    </label>

    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}">

</div>

<div class="mb-3">

    <label class="form-label">
        Email
    </label>

    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}">

</div>

<div class="mb-3">

    <label class="form-label">
        Password
    </label>

    <input type="password" name="password" class="form-control">

    @isset($user)
        <small class="text-muted">
            Kosongkan jika tidak ingin mengubah password.
        </small>
    @endisset

</div>

<div class="mb-3">

    <label class="form-label">
        Role
    </label>

    <select name="role" class="form-select">

        <option value="">-- Pilih Role --</option>

        <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>
            Admin
        </option>

        <option value="karyawan" {{ old('role', $user->role ?? '') == 'karyawan' ? 'selected' : '' }}>
            Karyawan
        </option>

    </select>

</div>
