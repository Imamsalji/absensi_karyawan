<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Absensi Hari Ini {{ $today }}</h3>

                    @if (session('success'))
                        <div class="alert alert-success mt-2">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                    @endif

                    <div class="mt-3">
                        <form action="{{ route('attendance.clockin') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary">Clock In</button>
                        </form>

                        <form action="{{ route('attendance.clockout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger">Clock Out</button>
                        </form>
                    </div>

                    <hr>

                    <h4>Filter</h4>
                    <form method="GET" action="{{ route('attendance.index') }}" class="row g-3 mt-2 mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}"
                                class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Akhir</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}"
                                class="form-control">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Clock In</th>
                                <th>Clock Out</th>
                                <th>IP Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendance as $item)
                                <tr>
                                    <td>{{ $item->work_date }}</td>
                                    <td>{{ $item->clock_in_at }}</td>
                                    <td>{{ $item->clock_out_at ? $item->clock_out_at : 'Belum melakukan Clock-Out' }}
                                    </td>
                                    <td>{{ $item->ip_address }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
