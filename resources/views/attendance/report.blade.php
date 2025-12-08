<x-app-layout>
    <div class="container mt-4">

        <h3 class="mb-3">Laporan Absensi Karyawan</h3>

        @if (session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mt-2">{{ session('error') }}</div>
        @endif

        <form method="GET" action="{{ route('attendance.report') }}" class="row g-3 mt-2 mb-4">
            <div class="col-md-4">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">User Id</label>
                <input type="text" name="userid" value="{{ request('userid') }}" class="form-control">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">Filter</button>
                <a href="{{ route('attendance.report') }}" class="btn btn-secondary me-2">Reset</a>
                <button type="button" onclick="window.print()" class="btn btn-success mt-2">
                    Cetak Laporan
                </button>
            </div>
        </form>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Clock In</th>
                    <th>Clock Out</th>
                    <th>Status</th>
                    {{-- <th>Durasi Kerja</th> --}}
                    <th>IP Address</th>
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>

            <tbody>
                @foreach ($report as $index => $item)
                    @php
                        $durasi = '-';
                        if ($item->clock_in_at && $item->clock_out_at) {
                            $durasi = \Carbon\Carbon::parse($item->clock_in_at)
                                ->diff(\Carbon\Carbon::parse($item->clock_out_at))
                                ->format('%H jam %I menit');
                        }
                    @endphp

                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->work_date }}</td>
                        <td>{{ $item->clock_in_at }}</td>
                        <td>{{ $item->clock_out_at ?? '-' }}</td>

                        {{-- <td>
                            @if ($item->status === 'Terlambat')
                                <span class="badge bg-danger">Terlambat</span>
                            @elseif ($item->status === 'Tepat Waktu')
                                <span class="badge bg-success">Tepat Waktu</span>
                            @else
                                <span class="badge bg-secondary">-</span>
                            @endif
                        </td> --}}

                        <td>{{ $durasi }}</td>
                        <td>{{ $item->ip_address }}</td>
                        {{-- <td>
                            <a href="{{ route('attendance.history', $item->user_id) }}" class="btn btn-sm btn-info">
                                Detail
                            </a>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</x-app-layout>
