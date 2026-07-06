<x-app-layout>

    <x-slot name="header">
        <h2 class="fw-bold fs-4">
            Manajemen User
        </h2>
    </x-slot>

    <div class="container py-4">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    Data User
                </h5>

                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    + Tambah User
                </a>

            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th width="70">No</th>

                            <th>Nama</th>

                            <th>Email</th>

                            <th>Role</th>

                            <th width="180">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($users as $user)
                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $user->name }}</td>

                                <td>{{ $user->email }}</td>

                                <td>

                                    @if ($user->role == 'admin')
                                        <span class="badge bg-primary">
                                            Admin
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            Karyawan
                                        </span>
                                    @endif

                                </td>

                                <td>

                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">

                                        Edit

                                    </a>

                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Yakin hapus data?')"
                                            class="btn btn-danger btn-sm">

                                            Hapus

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center">
                                    Tidak ada data
                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>
