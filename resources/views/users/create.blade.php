<x-app-layout>

    <x-slot name="header">
        <h2 class="fw-bold fs-4">
            Tambah User
        </h2>
    </x-slot>

    <div class="container py-4">

        <div class="card shadow">

            <div class="card-body">

                <form action="{{ route('users.store') }}" method="POST">

                    @csrf

                    @include('users.form')

                    <button class="btn btn-primary">
                        Simpan
                    </button>

                    <a href="{{ route('users.index') }}" class="btn btn-secondary">

                        Kembali

                    </a>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
